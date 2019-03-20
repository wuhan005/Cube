<?php
require_once('../core/Functions.php');
require_once('../core/CubeModule.php');

class ModuleLoader
{
    //The Cube system's module name.
    //The user can't use these name.
    private $sysModule = ['Main','Setting','Account','Manager','Data', 'Security'];

    private $cubeModule; //Now module.

    private $moduleHeader;
    private $modulePath;
    private $moduleName;
    private $isSystem;

    private $isError;

    public $module; //The module info used by the loader.
    public $nowModule;

    //The INIT and the LOAD should be separated.

    public function Init($moduleName){
        $this->isSystem = in_array($moduleName , $this->sysModule);

        //GET THE MODULE HEADER DATA HERE!!!
        $this->moduleHeader = $this->getHeaderData($moduleName,$this->isSystem);

        //If it's user made system's module,turn error.
        if($this->isSystem){
            if($this->moduleHeader['System'] !== True ){
                back_error();
                die();
            }
        }


        $this->setData();   //Get the module's data.
    }

    //Set the data for users.
    private function setData(){

        //The module headers which users can only use.
        //'module[]' will be sent to the user in the ModuleStage.
        $this->module['Name'] = $this->moduleHeader['Name'];
        $this->module['Version'] = $this->emptyFix($this->moduleHeader['Version']);
        $this->module['Description'] = $this->emptyFix($this->moduleHeader['Description']);
        $this->module['Icon'] = $this->emptyFix($this->moduleHeader['Icon']);
        $this->module['Author'] = $this->emptyFix($this->moduleHeader['Author']);
        $this->module['AuthorURI'] = $this->emptyFix($this->moduleHeader['AuthorURI']);
        $this->module['Auth'] = $this->emptyFix($this->moduleHeader['Auth']);
        $this->module['PathName'] = $this->moduleName;    //The module folder's name.
        $this->module['Path'] = $this->moduleHeader['Path'];
        $this->module['ResPath'] = COREPATH . '/public/Module/' . $this->moduleName . '/';
    }

    //PUBLIC USED. Load the module.
    public function Load(){

        global $db;
        global $mod;

        //If the module is users', judge the module is started or not.
        if(!$this->isSystem and !in_array($this->moduleName,$db->getOnModule()) and !$this->isError){
            $this->moduleHeader = $this->forbiddenPage(); //Set the forbidden data.
            $this->setData();  //Refresh the module data.
        }

        //$this->loadStage($this->isSystem);

        define('isSystem', $this->isSystem);    //Set the module's type, can't be edited.

        require_once($this->module['Path']);    //Load the module file.


        if($this->isError) return;      //If it is error page, load the content then return.

        //Make sure it is a standard module.
        if(!class_exists($this->module['PathName'])){
            Alert::show('不是标准的小工具，停止加载。');
        }

        //Load the module.
        $this->cubeModule = new $this->module['PathName']();
        $this->cubeModule->Module = $this->module;
        $this->cubeModule->router[''] = $this->module['PathName'];  //Add the module main page into the router.
        $this->cubeModule->Storage = new Storage($this->moduleName);     //Init the Storage part.

        //Child page router.
        $nowPage = Method::getChildPage();
        $router = $this->cubeModule->router;

        if($nowPage != null AND array_key_exists($nowPage, $router)){
            $pageFunction = $router[$nowPage];
        }else{
            //If the router is '', then to mainpage.
            $pageFunction = $this->cubeModule->router[''];
        }

        //Execute!
        //Make sure the account access.
        if(($this->module['Auth'] == 'Yes' AND $mod->isLogin()) || $this->module['Auth'] != 'Yes'){
            $this->cubeModule->$pageFunction();
        }else{
            redirect('/Account');
        }
    }

    public function getSystemModule(){
        return $this->sysModule;
    }

    private function getHeaderData($moduleName, $isSystem = false){

        $this->moduleName = $moduleName;
        $this->isSystem = $isSystem;

        if($isSystem){
            $this->modulePath = COREPATH . '/core/module/' . $moduleName .'/' . $moduleName . '.php';
        }else{
            $this->modulePath = COREPATH . '/public/Module/'. $moduleName .'/' . $moduleName . '.php';
        }

        //Make sure the main PHP file is existed.
        if(!file_exists($this->modulePath)){
            //Return error header.
            //404 Error.
            $this->isError = true;
            return $this->notFoundPage();
        }else{
            return $this->readHeaders();
        }
    }

    private function readHeaders(){
        //Just read the file.
        $fp = fopen($this->modulePath,'r');
        $file_data = fread($fp,filesize($this->modulePath));
        fclose($fp);

        //Make sure we catch CR-only line endings.
        $file_data = str_replace("\r", "\n", $file_data);

        //The back array's format.
        $allHeaders = array(
            'Name'        => 'Module Name',
            'Version'     => 'Version',
            'Description' => 'Description',
            'Icon'        => 'Icon',
            'Author'      => 'Author',
            'AuthorURI'   => 'Author URI',
            'Auth'        => 'Auth',    //Need login to access
        );
        foreach ( $allHeaders as $field => $regex ) {
            if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, $match ) && $match[1] ) {
                $allHeaders[ $field ] = $this->_cleanup_header_comment( $match[1] );
                //Has the useless part.
            } else {
                $allHeaders[ $field ] = '';
            }
        }

        //Add the isSystem info.
        if($this->isSystem){
            $allHeaders['System'] = True;
        }else{
            $allHeaders['System'] = False;
        }

        //Add the path, used by the ModuleStage
        $allHeaders['Path'] = $this->modulePath;

        //Make sure the headers is correct.
        //'Name','Path' is not empty.
        if( ( $allHeaders['Name'] == '' ) or ( $allHeaders['Path'] == '') ){
            $this->isError = true;
            return $this->errorPage('UNTITLED');
        }else{
            return $allHeaders;
        }
    }

    //If the main PHP is missing, return a error page header.
    private function errorPage($moduleName){
        $errorHeaders = array(
            'Name'        => '[错误] '.$moduleName,
            'Version'     => '1.0',
            'Description' => '该小工具存在一个错误，无法运行！',
            'Icon'        => 'bug',
            'Author'      => '',
            'AuthorURI'   => '',
            'Auth'        => '',
            'Path'        => COREPATH . '/core/module/Error/Error.php'
        );
        return $errorHeaders;
    }
    
    //Forbidden page.
    private function forbiddenPage($title='',$subtitle='抱歉，您无权访问！'){
        $forbiddenHeaders = array(
            'Name'        => '[禁止访问] '.$title,
            'Version'     => '',
            'Description' => $subtitle,
            'Icon'        => '',
            'Author'      => '',
            'AuthorURI'   => '',
            'Auth'        => '',
            'Path'        => COREPATH . '/core/module/Forbidden/Forbidden.php'
        );
        return $forbiddenHeaders;
    }

    //404 Not Found
    private function notFoundPage(){
        $notFoundHeaders = array(
            'Name'        => '404 Not Found',
            'Version'     => '',
            'Description' => '',
            'Icon'        => '',
            'Author'      => '',
            'AuthorURI'   => '',
            'Auth'        => '',
            'Path'        => COREPATH . '/core/module/404/404.php'
        );
        return $notFoundHeaders;
    }
    
    //Clean the useless part.
    private  function _cleanup_header_comment( $str ) {
        return trim( preg_replace( '/\s*(?:\*\/|\?>).*/', '', $str ) );
    }

    //Make the 'null' to empty or it occurs WARNING.
    private function emptyFix($arrayValue){
        if($arrayValue == null){
            return '';
        }else{
            return $arrayValue;
        }
    }
}
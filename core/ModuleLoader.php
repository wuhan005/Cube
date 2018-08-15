<?php
require_once('core/Functions.php');
// Storage part.
require_once('Storage.php');

class ModuleLoader
{
    //The Cube system's module name.
    //The user can't use these name.
    private $sysModule = ['Main','Setting','Account','Manager','Data'];

    private $moduleHeader;
    private $modulePath;
    private $moduleName;
    private $isSystem;

    public $module; //The module info which display in stage.
    public $nowModule;

    public $Storage;    //Storage API

    //The INIT and the LOAD should be separated.

    public function Init($moduleName){
        $isSystem = in_array($moduleName , $this->sysModule);

        //GET THE MODULE HEADER HERE!!!
        $this->moduleHeader = $this->get_module_header($moduleName,$isSystem);

        //If it's system module,turn error.
        if($isSystem){
            if($this->moduleHeader['System'] != True ){
                back_error();
                die();
            }
        }

        $this->setData();
    }

    //Set the data for users.
    private function setData(){
        $nowModule = $this->module['Name'];

        //The module headers which users can only use.
        //'module[]' will be sent to the user in the ModuleStage.
        $this->module['Name'] = $this->moduleHeader['Name'];
        $this->module['Version'] = $this->emptyFix($this->moduleHeader['Version']);
        $this->module['Description'] = $this->emptyFix($this->moduleHeader['Description']);
        $this->module['Icon'] = $this->emptyFix($this->moduleHeader['Icon']);
        $this->module['Author'] = $this->emptyFix($this->moduleHeader['Author']);
        $this->module['AuthorURI'] = $this->emptyFix($this->moduleHeader['AuthorURI']);
        $this->module['PathName'] = $this->moduleName;    //The module folder's name.
        $this->module['Path'] = $this->moduleHeader['Path'];
    }

    //PUBLIC USED. Load the module.
    public function Load(){
        global $db;
        //If the module is users', judge the module is started or not.
        if(!$this->isSystem and !in_array($this->moduleName,$db->getOnModule())){
            $this->moduleHeader = $this->forbiddenPage();
            $this->setData();   //Set the forbidden data.
        }
        //Loaded!
        $this->loadStage($this->isSystem);
    }

    private function loadStage($isSystem){
        define('isSystem', $isSystem);

        $this->Storage = new Storage($this->module['PathName']);

        //Sandbox.
        require_once('core/ModuleStage.php');
    }

    private function get_module_header($moduleName,$isSystem=false){

        $this->moduleName = $moduleName;
        $this->isSystem = $isSystem;

        if($isSystem){
            $this->modulePath = 'core/module/' . $moduleName .'/' . $moduleName . '.php';
        }else{
            $this->modulePath = 'Module/'. $moduleName .'/' . $moduleName . '.php';
        }
    
        //Make sure the main PHP file is existed.
        if(!file_exists($this->modulePath)){
            //Return error header.
            return $this->errorPage($this->moduleName);
        }else{
            return $this->getHeaders();
        }
    }

    private function getHeaders(){
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
            'AuthorURI'   => 'Author URI'
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
            'Path'        => './core/module/Error/Error.php'
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
            'Path'        => './core/module/Forbidden/Forbidden.php'
        );
        return $forbiddenHeaders;
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
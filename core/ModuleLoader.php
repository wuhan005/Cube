<?php
require_once('core/Functions.php');

//The Cube system's module name.
//The user can't use these name.
class ModuleLoader
{
    private $sysModule = ['Main','Setting'];

    public $module; //The module info which display in stage.

    public function Load($moduleName){
        $isSystem = in_array($moduleName , $this->sysModule);
        $moduleHeader = $this->get_module_header($moduleName,$isSystem);

        //If it's system module,turn error.
        if($isSystem){
            if($moduleHeader['System'] != 'True' ){
                back_error();
                die();
            }
        }
        $this->module['Name'] = $moduleHeader['Name'];
        $this->module['Version'] = $moduleHeader['Version'];
        $this->module['Description'] = $moduleHeader['Description'];
        $this->module['Author'] = $moduleHeader['Author'];
        $this->module['AuthorURI'] = $moduleHeader['AuthorURI'];
        $this->module['Path'] = $moduleHeader['Path'];
        
        //Loaded!
        $this->loadStage();
        
    }

    private function loadStage(){
        require_once('core/ModuleStage.php');
    }

    private function get_module_header($moduleName,$isSystem=false){
        if($isSystem){
            $modulePath = 'core/module/' . $moduleName .'/' . $moduleName . '.php';
        }else{
            $modulePath = 'Module/'. $moduleName .'/' . $moduleName . '.php';
        }
    
        //Just read the file.
        $fp = fopen($modulePath,'r');
        $file_data = fread($fp,filesize($modulePath));
        fclose($fp);
    
        //Make sure we catch CR-only line endings.
        $file_data = str_replace("\r", "\n", $file_data);
    
        //The back array's format.
        $allHeaders = array(
            'Name'        => 'Module Name',
            'Version'     => 'Version',
            'Description' => 'Description',
            'Author'      => 'Author',
            'AuthorURI'   => 'Author URI',
        );
    
        foreach ( $allHeaders as $field => $regex ) {
            if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, $match ) && $match[1] ) {
                $allHeaders[ $field ] = $this->_cleanup_header_comment( $match[1] );
                //Has the useless part.
            } else {
                $allHeaders[ $field ] = '';
            }   
        }
    
        if($isSystem){
            $allHeaders['System'] = 'True';
        }
    
        //Add the path, used by the ModuleStage
        $allHeaders['Path'] = $modulePath;
    
        return $allHeaders;
    }
    
    //Clean the useless part.
    private  function _cleanup_header_comment( $str ) {
        return trim( preg_replace( '/\s*(?:\*\/|\?>).*/', '', $str ) );
    }
}
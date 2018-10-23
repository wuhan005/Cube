<?php
//Modules extends from this class.

// Storage part.
require_once('Storage.php');

class CubeModule
{

    public $Module;
    public $Storage;     //Data storage API.
    public $Setting;    //Setting API.
    protected $db;          //Database API.
    protected $mod;
    public $router = [];     //URL Router

    //Module Setting
    protected $settingName;


    public function __construct(){
        global $mod;
        $this->mod = $mod;  //Load the public function.

        $this->settingName = $this->Module['Name'];     //The setting name is the module name at first.

        //If it is system module, load the database API.
        if(isSystem){
            global $db;
            $this->db = $db;
        }else{
            unset($this->db);
        }

    }

    //When the module is being install firstly.
    protected function __Init(){

    }

    protected function LoadPage($pageName){
        $filePath = BASEPATH . "/Module/{$this->Module['PathName']}/" . $pageName;

        if(file_exists($filePath)){
            require_once($filePath);
        }else{
            Alert::show('找不到页面 ' . $pageName, ERROR);
            return false;
        }
    }



}
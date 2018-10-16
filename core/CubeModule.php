<?php
//Modules extends from this class.

// Storage part.
require_once('Storage.php');

// Setting part.
require_once('Setting.php');

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
        if(file_exists($pageName . '.php')){
            require_once($pageName . '.php');
        }else if(file_exists($pageName . '.html')){
            require_once($pageName . '.html');
        }else{

        }
    }

    protected function AddSetting($setting){
        return $this->Setting->add_setting($setting);
    }

    protected function GetSetting($name){
        return $this->Setting->get_setting($name);
    }

    protected function SetSetting($name, $data){
        return $this->Setting->set_setting($name, $data);
    }


}
<?php
//Modules extends from this class.

// Storage part.
require_once('Storage.php');

class CubeModule
{

    public $Module;
    public $Storage;     //Data storage API.
    protected $db;          //Database API.
    protected $mod;
    public $router = [];     //URL Router

    public function __construct(){
        global $mod;
        $this->mod = $mod;  //Load the public function.

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
        if(file_exists($pageName)){
            require_once($pageName);
        }else{
            //TODO
        }
    }


}
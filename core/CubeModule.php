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
    protected $ResURL;


    public function __construct(){
        global $mod;
        $this->mod = $mod;  //Load the public function.

        $this->settingName = $this->Module['Name'];     //The setting name is the module name at first.
        $this->ResURL = "/Module/{$this->Module['PathName']}";     //The module's path, used to load the static file.

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

    //Static Resource URL.
    protected function ResURL(){
        echo("/Module/{$this->Module['PathName']}");
    }


    //Load all kinds of file.
    protected function Load($fileName){
        $fileAbsPath = BASEPATH . "/Module/{$this->Module['PathName']}/" . $fileName;
        $fileRelPath = "/Module/{$this->Module['PathName']}/" . $fileName;
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if(in_array($fileType, Config::$allowedFile)){
            if(file_exists($fileAbsPath)){      //Use absolute path to check the file.
                //Judge the file type.
                switch($fileType){      //Use the relative path to load the static file. The php file should use the absolute path.
                    case 'php':
                        require_once($fileAbsPath);
                        return true;
                        break;
                    case 'css':
                        echo("<link rel=\"stylesheet\" href=\"$fileRelPath\" type=\"text/css\">");
                        return true;
                        break;
                    case 'js':
                        echo("<script src=\"$fileRelPath\" type=\"text/javascript\"></script>");
                        return true;
                        break;
                    default:
                        echo($fileRelPath);
                        return true;
                }

            }else{
                Alert::show('找不到文件 ' . $fileName, ERROR);
                return false;
            }
        }else{
            Alert::show('不允许的文件后缀： ' . $fileType, ERROR);
        }

    }



}
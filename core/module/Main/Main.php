<?php
/*
Module Name: Cube
Description: Be cool. But also be warm.
Author: John Wu
Author URI: https://wuhan5.cc/
Version: 1.0.0
*/

require_once('core/ModuleFinder.php');
require_once('core/ModuleLoader.php');

class Main extends CubeModule{

    private $mFinder;
    private $mLoader;
    private $moduleList;
    private $moduleDetailList;
    private $errorModuleNumber;

    public function __construct(){

        parent::__construct();

        $this->mFinder = new ModuleFinder();
        $this->moduleList = $this->mFinder->getModuleList();
        $this->mLoader = new ModuleLoader();  //Used to load the single module.

    }

    public function Main(){

        $this->moduleDetailList = array();
        $this->errorModuleNumber = 0;

        foreach($this->moduleList as $value){
            $this->mLoader->Init($value);
            $this->moduleDetailList[] = $this->mLoader->module;   //Add the single module's info to the detail list.

            //Judge if the module is error by the path.
            if($this->mLoader->module['Path'] == '/core/module/Error/Error.php'){
                $this->errorModuleNumber++;
            }
        }

        require_once('Main_mainpage.php');
    }
}


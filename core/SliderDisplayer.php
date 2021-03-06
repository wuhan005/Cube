<?php
//Manage the slider UI.
require_once('ModuleFinder.php');
require_once('ModuleLoader.php');

class SliderDisplayer{
    private $mFinder;
    private $moduleList;
    private $mLoader;
    private $onModule;

    public $nowPage; //Data from the Cube.php

    public function __construct(){
        global $db;
        $this->mFinder = new ModuleFinder();
        $this->moduleList = $this->mFinder->getModuleList();
        $this->mLoader = new ModuleLoader();    //Used to get the module name.
        $this->onModule = $db->getOnModule();
    }

    public function showSlider(){
        foreach($this->moduleList as $module){
            $this->mLoader->Init($module);
            $modulePathName = $this->mLoader->module['PathName'];
            //Judge the module is started or not.
            if(in_array($modulePathName,$this->onModule)){
                $moduleName = $this->mLoader->module['Name'];
                $moduleIcon = $this->mLoader->module['Icon'];

                echo('<li ' . $this->active($modulePathName) . '><a href="/' . $module . '"><i class="icon mdi mdi-' . $moduleIcon . '"></i><span>');
                echo($moduleName); //Module Name
                echo('</span></a></li>');
            }
        }
    }

    public function topPage($pageName){
        if($pageName == 'Main'){
            return 'Home';
        }else if(in_array($pageName, $this->mLoader->getSystemModule())){
            return 'Options';
        }else{
            return 'Tools';
        }
    }

    public function active($moduleName){
        if($moduleName == $this->nowPage){
            return 'class="active"';
        }else{
            return '';
        }
    }
    

}
<?php
//Manage the slider UI.
require_once('ModuleFinder.php');
require_once('ModuleLoader.php');

class SliderDisplayer{
    private $mFinder;
    private $moduleList;
    private $mLoader;

    public $nowPage; //Data from the Cube.php

    public function __construct(){
        $this->mFinder = new ModuleFinder();
        $this->moduleList = $this->mFinder->getModuleList();
        $this->mLoader = new ModuleLoader();    //Used to get the module name.
    }

    public function showSlider(){
        foreach($this->moduleList as $module){

            $this->mLoader->Init($module);
            $moduleName = $this->mLoader->module['Name'];
            $moduleIcon = $this->mLoader->module['Icon'];
            $modulePathName = $this->mLoader->module['PathName'];

            echo('<li ' . $this->active($modulePathName) . '><a href="' . $module . '"><i class="icon mdi mdi-' . $moduleIcon . '"></i><span>');
            echo($moduleName); //Module Name
            echo('</span></a></li>');
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
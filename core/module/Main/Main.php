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

$mFinder = new ModuleFinder();
$moduleList = $mFinder->getModuleList();

$mLoader = new ModuleLoader();  //Used to load the single module.

$moduleDetailList = array();
$errorModuleNumber = 0;

foreach($moduleList as $value){
    $mLoader->Init($value); 
    $moduleDetailList[] = $mLoader->module;   //Add the single module's info to the detail list.
    
    //Judge if the module is error by the path.
    if($mLoader->module['Path'] == '/core/module/Error/Error.php'){
        $errorModuleNumber++;
    }
}

require_once('Main_mainpage.php');

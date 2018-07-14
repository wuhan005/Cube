<?php
/*
Module Name: Manager
Description: 管理每一个小工具
Author: John Wu
Author URI: Link to the author's web site
Version: 1.0.0
*/

require_once('core/ModuleFinder.php');
require_once('core/ModuleLoader.php');



$mFinder = new ModuleFinder();
$moduleList = $mFinder->getModuleList();

$mLoader = new ModuleLoader();  //Used to load the single module.


$moduleDetailList = array();

foreach($moduleList as $value){
    $mLoader->Init($value); 
    $moduleDetailList[] = $mLoader->module;   //Add the single module's info to the detail list.
}

require_once('Manager_mainpage.php');

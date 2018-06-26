<?php

//URL Router
$urlPathInfo = @explode('/',$_SERVER['PATH_INFO']);
$nowPage = @$urlPathInfo[1];
if($nowPage == null){
    //If it is /index.php, then go to the mainpage.
    $nowPage = 'Main';
}

//Load the UI part.
require_once 'core/SlideBar.php';

//Load the module
require_once 'core/ModuleLoader.php';
$mLoader = new ModuleLoader;
$mLoader->Load($nowPage);
<?php

//URL Router
$urlPathInfo = @explode('/',$_SERVER['PATH_INFO']);
$nowPage = @$urlPathInfo[1];
if($nowPage == null){
    //If it is /index.php, then go to the mainpage.
    $nowPage = 'Main';
}

//PAY ATTENTION TO THE LOADING ORDER.

//Init the module.
require_once 'core/ModuleLoader.php';
$mLoader = new ModuleLoader;
$mLoader->Init($nowPage);

//Load the UI part.
require_once 'core/SlideBar.php';

//Load the module.
$mLoader->Load();

//Load the footer.
require_once 'core/Footer.php';
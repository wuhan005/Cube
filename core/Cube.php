<?php

//Start Session.
session_start();

$qqq = '123456 d';

//URL Router, used to load main page.
$urlPathInfo = @explode('/',$_SERVER['PATH_INFO']);
$nowPage = @$urlPathInfo[1];
if($nowPage == null){
    //If it is /index.php, then go to the mainpage.
    $nowPage = 'Main';
}

//PAY ATTENTION TO THE LOADING ORDER.

//Load the database.
require_once 'DataBase.php';
$db = new DataBase;
$db->Init();

// Public Method
require_once('Method.php');
$mod = new Method;

//Init the module.
require_once 'core/ModuleLoader.php';
$mLoader = new ModuleLoader;
$mLoader->Init($nowPage);

//Init the silder.
require_once 'core/SliderDisplayer.php';
$slider = new SliderDisplayer;
$slider->nowPage = $nowPage;    //Used to control the active class.

//Load the UI part.
require_once 'core/SlideBar.php';

//Load the module.
$mLoader->Load();

//Load the footer.
require_once 'core/Footer.php';
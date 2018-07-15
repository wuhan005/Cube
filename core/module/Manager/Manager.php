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

$onModule = $db->getOnModule();

$moduleDetailList = array();

foreach($moduleList as $value){
    $mLoader->Init($value); 
    $moduleInfo = $mLoader->module;
    //Add the Module is START or not info.
    $moduleInfo['isStart'] = in_array($mLoader->module['PathName'],$onModule);

    $moduleDetailList[] = $moduleInfo;  //Add the single module's info to the detail list.
}

function startModule(){
    global $db;
    if(isset($_GET['moduleName'])){
        $db->startModule($_GET['moduleName']);
    }else{
        //Missing the module name, turn error.
    }
}

function offModule(){
    global $db;
    if(isset($_GET['moduleName'])){
        $db->offModule($_GET['moduleName']);
    }else{
        //Missing the module name, turn error.
    }
}

//ACTIONS HERE.
//Judge if there is an action parameter.
if(isset($_GET['action'])){
    switch($_GET['action']){
        case 'startModule':
        startModule();
        break;
        case 'offModule':
        offModule();
        break;
    }
}

function dropdown($PathName,$isStart){
    //Judge the UI.
    if($isStart){
        $buttomLabel = '启用';
        $dropitemLabel = '关闭';
        $dropitemURL = '?action=offModule&moduleName=' . $PathName;
    }else{
        $buttomLabel = '关闭';
        $dropitemLabel = '启用';
        $dropitemURL = '?action=startModule&moduleName=' . $PathName;
    }
    
    echo('
    <td class="text-right">
    <div class="btn-group btn-hspace">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">' . $buttomLabel . '<span class="icon-dropdown mdi mdi-chevron-down"></span></button>
        <div class="dropdown-menu" role="menu"><a class="dropdown-item" href="' . $dropitemURL . '">' . $dropitemLabel . '</a>
        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">删除</a>
        </div>
    </div>
    </td>
    </tr>
    ');
}

//Load the mainpage.
require_once('Manager_mainpage.php');

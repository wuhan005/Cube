<?php
    //API gives to user.

    // Module Basic Data
    $Module = $this->module;    //Make it easy to ues.

    //Public method.
    global $mod;

    // System Only Method
    if(isSystem){
        // Database
        global $db;
    }

    //Load the main file.
    require_once $Module['Path'];

    //URL Router, used to load the second page in the module.
    $urlPathInfo = @explode('/', $_SERVER['PATH_INFO']);
    $nowPage = @$urlPathInfo[2];
    if($nowPage != null AND array_key_exists($nowPage, $this->router)){
        $pageFunction = $this->router[$nowPage];

        //Execute!
        $pageFunction();
    }
?>
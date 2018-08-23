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

    $nowPage = Method::getChildPage();
    if($nowPage != null AND array_key_exists($nowPage, $this->router)){
        $pageFunction = $this->router[$nowPage];

        //Execute!
        $pageFunction();
    }else if($nowPage == null AND array_key_exists('', $this->router)){
        //If the router is '', then to mainpage.
        $pageFunction = $this->router[''];

        //Execute!
        $pageFunction();
    }
?>
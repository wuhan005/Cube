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
?>
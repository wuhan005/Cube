<?php
/*
Module Name: Account
Description: 管理账户
Author: John Wu
Author URI: https://wuhan5.cc/
Version: 1.0.0
*/

// URL Router.
$nowPage = $mod->get_current_page();

switch($nowPage){
    //Submit the form from the login page.
    case 'Account':
        // Judge the user login or not.
        if(!isset($_COOKIE['AccountName'])){
            require_once('Account_Login.php');
        }else{
            if(isLogin()){
                require_once('Account_Dashboard.php');
            }else{
                require_once('Account_Login.php');
            }
        }
    break;
    case 'LoginAction':
        loginAction();
    break;
}


function loginAction(){
    global $db;

    $nowName = $_POST['Name'];
    $nowPasswd = $_POST['Passwd'];

    $realName = $db->getAccountData()['Account_Name'];
    $realPasswd = $db->getAccountData()['Account_Password'];

    if($realName == $nowName AND $realPasswd == $nowPasswd){
        //Set cookies, 1 hours.
        setcookie('AccountName', $nowName, time()+3600);
        setcookie('AccountPasswd', $nowPasswd, time()+3600);

        redirect('http://www.cube.com/Account');
        
    }else{
        echo('false');
    }
}

function isLogin(){
    global $db;


    $nowName = $_COOKIE['AccountName'];
    $nowPasswd = $_COOKIE['AccountPasswd'];

    $realName = $db->getAccountData()['Account_Name'];
    $realPasswd = $db->getAccountData()['Account_Password'];

    return ($realName == $nowName AND $realPasswd == $nowPasswd);
}


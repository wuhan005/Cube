<?php
/*
Module Name: Account
Description: 管理账户
Author: John Wu
Author URI: https://wuhan5.cc/
Version: 1.0.0
*/

class Account extends CubeModule{
    public function __construct(){
        parent::__construct();

        //Register router.
        $this->router[''] = 'accountDashboard';
        $this->router['Profile'] = 'changeProfile';
        $this->router['UpdateProfileAction'] = 'update_profile';
        $this->router['LoginAction'] = 'loginAction';
        $this->router['LogoutAction'] = 'logoutAction';
    }


    //Page: dashboard
    public function Account(){
        global $db;
        global $mod;

        if(!isset($_SESSION['AccountName'])){
            require_once('Account_Login.php');
        }else{
            if($mod->isLogin()){
                require_once('Account_Dashboard.php');
            }else{
                require_once('Account_Login.php');
            }
        }
    }

    //Page: change password.
    public function changeProfile(){
        global $db;
        $userMail = $db->getAccountData()['Account_Mail'];
        $userName = $db->getAccountData()['Account_Name'];

        require_once('Account_ChangeProfile.php');
    }

    public function update_profile(){
        global $db;

        if(isset($_POST)){
            $arrayData['Account_Name'] = $_POST['name'];
            $arrayData['Account_Mail'] = $_POST['mail'];
            $arrayData['Account_Password'] = hash('sha256', $_POST['password'] . $db->getSetting('Salt'));

            $db->updateAccountData($arrayData, $db->getAccountData()['Account_ID']);
            redirect('/Account');
        }else{
            redirect('/Account');
        }
    }

    public function loginAction(){
        global $db;

        $nowName = $_POST['Name'];
        $nowPasswd = $_POST['Passwd'];

        //Encrypt the password.
        $encryptNowPasswd = hash('sha256',$nowPasswd . $db->getSetting('Salt'));

        $realName = $db->getAccountData()['Account_Name'];
        $realPasswd = $db->getAccountData()['Account_Password'];

        if($realName === $nowName AND $realPasswd === $encryptNowPasswd){
            //Use sessions.
            $_SESSION['AccountName'] = $nowName;
            $_SESSION['AccountPasswd'] = $nowPasswd;

            redirect('/Account');
        }else{
            redirect('/Account');
        }
    }

    public function logoutAction(){
        //Clean all the session.
        session_destroy();
        redirect('/Account');
    }

}

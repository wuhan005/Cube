<?php 
// Public Method

class Method{

    private $current_user_data = '';
    private $db;

    //Sandbox. Private load database.
    private function db(){
        require_once('DataBase.php');
        $this->db = new DataBase;
        $this->db->Init();
    }

    public function __construct(){
        $this->db();    //Init the database.
    }

    //Remove the key in an array.
    public static function remove_key($data, $key){
        if(!array_key_exists($key, $data)){
            return $data;
        }
        $keys = array_keys($data);
        $index = array_search($key, $keys);
        if($index !== FALSE){
            array_splice($data, $index, 1);
        }
        return $data;
    }

    //URL router.
    public function get_current_page(){
        $urlPathInfo = @explode('/',$_SERVER['PATH_INFO']);
        if(@$urlPathInfo[2] != '')
            return @$urlPathInfo[2];
        else{
            return @$urlPathInfo[1];
        }
    }

    //Get now date.
    public static function get_date(){
        return date('Y-m-d h:i:s',time());
    }

    public function isLogin(){ 
        $nowName = @$_COOKIE['AccountName'];
        $nowPasswd = @$_COOKIE['AccountPasswd'];
    
        $realName = $this->db->getAccountData()['Account_Name'];
        $realPasswd = $this->db->getAccountData()['Account_Password'];
    
        return ($realName == $nowName AND $realPasswd == $nowPasswd);
    }

    //Current user data, return isLogin, name, mail.
    public function get_current_login_user(){
        $nowName = @$_COOKIE['AccountName'];
        $nowPasswd = @$_COOKIE['AccountPasswd'];
    
        $realName = $this->db->getAccountData()['Account_Name'];
        $realPasswd = $this->db->getAccountData()['Account_Password'];
    
        if ($realName == $nowName AND $realPasswd == $nowPasswd){
            $data['isLogin'] = true;
            $data['name'] = $realName;
            $data['mail'] = $this->db->getAccountData()['Account_Mail'];      
        }else{
            $data['isLogin'] = false;
            $data['name'] = '???';
            $data['mail'] = '';
        }
        return $data;
    }

    //Get gravatar data.
    public static function get_gravatar($email='', $size = 80) {
        
        //Use Qiniu CDN for Chinese users.
        $url = 'https://dn-qiniu-avatar.qbox.me/json/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= '.json';
        $data = file_get_contents($url);
        $data = json_decode($data);

        $picURL = 'https://www.gravatar.com/avatar/';
        $picURL .= md5( strtolower( trim( $email ) ) );
        $picURL .= "?s=$size";

        $returnData['pic'] = $picURL;
        $returnData['name'] = $data->entry[0]->name->formatted;
        $returnData['url'] = $data->entry[0]->urls[0]->value;

        return $returnData;
    }

}
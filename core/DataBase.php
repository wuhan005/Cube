<?php
//Database connection & operation here.

require_once('ModuleFinder.php');

class DataBase{

    private $db;
    private $mFinder;

    //Init the database connection.
    public function Init(){
        $dsn = sprintf('mysql:host=%s;dbname=%s', Config::$DB_HOST, Config::$DB_NAME);
        $this->db = new PDO($dsn, Config::$DB_USER, Config::$DB_PASSWORD);
        $this->mFinder = new ModuleFinder();
        //$this->updateModule();
    }

    //Update the module info in the Setting table.
    public function updateModule(){
        $moduleList = json_encode($this->mFinder->getModuleList());

        //Update Module in the Cube.
        $query = $this->db->exec("UPDATE Setting SET Setting_Value = '$moduleList' WHERE `Setting_Name` = 'Module'");
		if (!$query) {
		    //TODO.
        }

        // $query = $this->db->query('SELECT * FROM Account');
        // $query = $query->fetchArray(SQLITE3_ASSOC);
        //var_dump($query);
    }

    public function startModule($moduleName){
        $moduleList = $this->mFinder->getModuleList();
        $onModule = $this->getOnModule();

        //Make sure the Module is not added so far and the it is existed in the folder.
        if(!in_array($moduleName,$onModule) and in_array($moduleName,$moduleList)){
            //Get the now start modules and add the new module into them.
            $onModule[] = $moduleName;
            $onModule = json_encode($onModule);

            $query = $this->db->prepare("UPDATE Setting SET Setting_Value = ? WHERE `Setting_Name` = 'OnModule'");
            $query->execute(array($onModule));

            refresh();
        }
    }

    public function offModule($moduleName){
        //Delete the data in the Setting_OnModule.
        $onModule = $this->getOnModule();
        //Make sure the Module is existed in the now data.
        if(in_array($moduleName,$onModule)){
            //Get the now start modules and add the new module into them.
            //Delete the element in the array.
            array_splice($onModule, array_search($moduleName, $onModule), 1);
            $onModule = json_encode($onModule);

            $query = $this->db->prepare("UPDATE Setting SET Setting_Value = ? WHERE `Setting_Name` = 'OnModule'");
            $query->execute(array($onModule));

            refresh();      // To show the message box.
        }
    }

    //Update the setting from the setting page.
    public function updateSetting($arrayData){
        foreach($arrayData as $key => $value){
            $query = $this->db->prepare('UPDATE Setting SET Setting_Value = ? WHERE `Setting_Name` = ?');
            $query->execute(array($value, $key));
        }
    }

    //Update user's account data.
    public function updateAccountData($arrayData, $nowUserID){
        foreach($arrayData as $key => $value){
            $query = $this->db->prepare('UPDATE `Account` SET ? = ? WHERE `Account_ID` = ?');
            $query->execute(array($key, $value, $nowUserID));
        }
    }

    //===============================Module Storage Part===============================//
    public function save_data($moduleName, $key, $value){
        $query = $this->db->prepare('SELECT * FROM `Storage` WHERE `Storage_ModuleName` = ?');
        $query->execute(array($moduleName));
        $query = $query->fetchAll(PDO::FETCH_ASSOC);

        if($query != false AND $query['Storage_Data'] != null){
            //Already have module data.
            $data = $query['Storage_Data'];
            $data = json_decode($data); //Get the data first.
            $data->$key = $value;  // Add or Edit the data.
            $data = json_encode($data);

            $query = $this->db->prepare('UPDATE `Storage` SET `Storage_Data` = ? WHERE `Storage_ModuleName` = ?');
            $query->execute(array($data, $moduleName));

        }else{

            //No module data before.
            $data = [];     //New array.
            $data[$key] = $value;
            $data = json_encode($data);
            $query = $this->db->prepare('INSERT INTO `Storage` (`Storage_ModuleName`, `Storage_Data`) VALUES (?, ?)');
            $query->execute(array($moduleName, $data));
        }
        
    }

    public function get_data($moduleName, $key){
        $query = $this->db->query('SELECT `Storage_Data` FROM `Storage` WHERE `Storage_ModuleName` = ?');
        $query->execute(array($moduleName));
        $query = $query->fetchAll(PDO::FETCH_ASSOC);

        if($query != false){
            $query = $query['Storage_Data'];    //Get all module data.
            $query = json_decode($query);
            return @$query->$key;
        }else{
            return false;
        }
    }

    public function delete_data($moduleName, $key){
        $query = $this->db->query('SELECT `Storage_Data` FROM `Storage` WHERE `Storage_ModuleName` = ?');
        $query->execute(array($moduleName));
        $query = $query->fetchAll(PDO::FETCH_ASSOC);

        //Make sure the key is existed. If not, do nothing.
        if($query != false AND $query['Storage_Data'] != null){
            $data = $query['Storage_Data'];    //Get all module data.
            $data = json_decode($data, true); //Return array.
            $data = Method::remove_key($data, $key);  //Remove the key
            $data = json_encode($data);
            $query = $this->db->prepaer('UPDATE `Storage` SET `Storage_Data` = ? WHERE `Storage_ModuleName` = ?');
            $query->execute(array($data, $moduleName));

        }
        return true;
    }

    public function clean_data($moduleName){
        $query = $this->db->prepare("DELETE FROM `Storage` WHERE `Storage_ModuleName` = ?");
        $query->execute(array($moduleName));
        return true;
    }
    //=================================================================================//

    public function getOnModule(){
        $query = $this->db->query("SELECT `Setting_Value` FROM `Setting` WHERE `Setting_Name` = 'OnModule'");
        $query->execute();
        $query = $query->fetchAll(PDO::FETCH_ASSOC);
        return json_decode($query[0]['Setting_Value']);  //Return array.
    }

    //Module get its own data.
    public function getStorageData(){
        $query = $this->db->query('SELECT * FROM `Storage`');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //Get the init modules, return Array.
    public function getInitModule(){
        $result = $this->getSetting('IsInitModule');
        $result = json_decode($result, true);

        return $result;
    }

    //Get single setting option's data.
    public function getSetting($Name){
        $query = $this->db->prepare('SELECT `Setting_Value` FROM `Setting` WHERE `Setting_Name` = ?');
        $query->execute(array($Name));
        $query = $query->fetchAll(PDO::FETCH_ASSOC);
        return $query[0]['Setting_Value'];  //Return array.
    }

    //IMPORTANT!
    public function getAccountData(){
        $query = $this->db->query('SELECT * FROM `Account`');
        $query->execute();
        $query = $query->fetchAll(PDO::FETCH_ASSOC);;
        return $query[0];  //Return array.
    }
    
}
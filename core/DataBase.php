<?php
//Database connection & operation here.

require_once('ModuleFinder.php');

class DataBase{

    private $db;
    private $mFinder;

    //Init the database connection.
    public function Init(){
        $this->db = new SQLite3(dirname( __FILE__ ) . '/database/Cube.db');
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

            $query = $this->db->exec("UPDATE Setting SET Setting_Value = '$onModule' WHERE `Setting_Name` = 'OnModule'");
            refresh();
        }
    }

    public function offModule($moduleName){
        //Delete the data in the Setting_OnModule.
        $moduleList = $this->mFinder->getModuleList();
        $onModule = $this->getOnModule();
        //Make sure the Module is existed in the now data.
        if(in_array($moduleName,$onModule)){
            //Get the now start modules and add the new module into them.
            //Delete the element in the array.
            array_splice($onModule, array_search($moduleName, $onModule), 1);
            $onModule = json_encode($onModule);

            $query = $this->db->exec("UPDATE Setting SET Setting_Value = '$onModule' WHERE `Setting_Name` = 'OnModule'");
            refresh();
        }
    }

    //Update the setting from the setting page.
    public function updateSetting($arrayData){
        foreach($arrayData as $key => $value){
            $this->db->query("UPDATE Setting SET Setting_Value = '$value' WHERE `Setting_Name` = '$key'");
        }
    }

    //Update user's account data.
    public function updateAccountData($arrayData, $nowUserID){
        foreach($arrayData as $key => $value){
            $this->db->query("UPDATE Account SET $key = '$value' WHERE `Account_ID` = '$nowUserID'");
        }
    }

    //===============================Module Storage Part===============================//
    public function save_data($moduleName, $key, $value){
        $query = $this->db->query("SELECT * FROM Storage WHERE `Storage_ModuleName` = '$moduleName'");
        $query = $query->fetchArray(SQLITE3_ASSOC);

        if($query != false AND $query['Storage_Data'] != null){
            //Already have module data.
            $data = $query['Storage_Data'];
            $data = json_decode($data); //Get the data first.
            $data->$key = $value;  // Add or Edit the data.
            $data = json_encode($data);
            $this->db->exec("UPDATE Storage SET Storage_Data = '$data' WHERE `Storage_ModuleName` = '$moduleName'");

        }else{

            //No module data before.
            $data = [];     //New array.
            $data[$key] = $value;
            $data = json_encode($data);
            $this->db->exec("INSERT INTO Storage (`Storage_ModuleName`, `Storage_Data`) VALUES ('$moduleName', '$data')");
        }
        
    }

    public function get_data($moduleName, $key){
        $query = $this->db->query("SELECT Storage_Data FROM Storage WHERE `Storage_ModuleName` = '$moduleName'");
        $query = $query->fetchArray(SQLITE3_ASSOC);

        if($query != false){
            $query = $query['Storage_Data'];    //Get all module data.
            $query = json_decode($query);
            return @$query->$key;
        }else{
            return false;
        }
    }

    public function delete_data($moduleName, $key){
        $query = $this->db->query("SELECT Storage_Data FROM Storage WHERE `Storage_ModuleName` = '$moduleName'");
        $query = $query->fetchArray(SQLITE3_ASSOC);

        //Make sure the key is existed. If not, do nothing.
        if($query != false AND $query['Storage_Data'] != null){
            $data = $query['Storage_Data'];    //Get all module data.
            $data = json_decode($data, true); //Return array.
            $data = Method::remove_key($data, $key);  //Remove the key
            $data = json_encode($data);
            $this->db->exec("UPDATE Storage SET Storage_Data = '$data' WHERE `Storage_ModuleName` = '$moduleName'");
        }
        return true;
    }

    public function clean_data($moduleName){
        $this->db->exec("DELETE FROM Storage WHERE `Storage_ModuleName` = '$moduleName'");
        return true;
    }
    //=================================================================================//


    //===============================Module Setting Part===============================//
    public function add_setting($_moduleID, $_setting){
        //Make sure the database has the module's setting field.

        $query = $this->db->query("SELECT * FROM Options WHERE `ModuleID` = $_moduleID");
        $query = $query->fetchArray(SQLITE3_ASSOC);

        //If empty, add the module's field.
        if($query == false OR empty($query)){
            $this->db->exec("INSERT INTO Options (`ModuleID`) VALUES ($_moduleID)");

            //Get the data again.
            $query = $this->db->query("SELECT * FROM Options WHERE `ModuleID` = $_moduleID");
            $query = $query->fetchArray(SQLITE3_ASSOC);
        }

        $settingItem = $query['Item'];
        $settingItem = json_decode($settingItem, true);

        $settingItem[] = $_setting;
        $settingItem = json_encode($settingItem);

        //Update the data.
        $this->db->exec("UPDATE Options SET Item = '$settingItem' WHERE `ModuleID` = '$_moduleID'");

        return true;    //Show good news.

    }

    public function get_setting($_name){
        $query = $this->db->query("SELECT * FROM Options WHERE `ModuleID` = $_moduleID");
        $query = $query->fetchArray(SQLITE3_ASSOC);

        if($query == false OR empty($query)){
            return false;
        }

        $settingItem = $query['Item'];
        $settingItem = json_decode($settingItem, true);

        if(isset($settingItem[$_name])){
            return $settingItem[$_name];
        }else{
            return false;
        }

    }

    public function set_setting($_name, $_data){
        //$query = $this->db->query("");
    }

    //=================================================================================//

    public function getOnModule(){
        $query = $this->db->query('SELECT Setting_Value FROM Setting WHERE `Setting_Name` = \'OnModule\'');
        $query = $query->fetchArray(SQLITE3_ASSOC);
        return json_decode($query['Setting_Value']);  //Return array.
    }

    //Module get its own data.
    public function getStorageData(){
        $query = $this->db->query('SELECT * FROM Storage');
        $returnResult = [];
        while($result = $query->fetchArray(SQLITE3_ASSOC)) {
            $returnResult[] = $result;
        }
        return $returnResult;
    }

    //Get the init modules, return Array.
    public function getInitModule(){
        $result = $this->getSetting('IsInitModule');
        $result = json_decode($result, true);

        return $result;
    }

    //Get single setting option's data.
    public function getSetting($Name){
        $query = $this->db->query("SELECT Setting_Value FROM Setting WHERE `Setting_Name` = '$Name'");
        $query = $query->fetchArray(SQLITE3_ASSOC);
        return $query['Setting_Value'];  //Return array.
    }

    //IMPORTANT!
    public function getAccountData(){
        $query = $this->db->query('SELECT * FROM Account');
        $query = $query->fetchArray(SQLITE3_ASSOC);
        return $query;  //Return array.
    }
    
}
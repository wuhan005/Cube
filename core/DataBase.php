<?php
//Database connection & operation here.

require_once('ModuleFinder.php');

class DataBase{

    private $db;
    private $mFinder;

    //Init the database connection.
    public function Init(){
        $this->db = new SQLite3('./database/Cube.db');
        $this->mFinder = new ModuleFinder();
        //$this->updateModule();
    }

    //Update the module info in the Setting table.
    public function updateModule(){
        $moduleList = json_encode($this->mFinder->getModuleList());

        //Update Module in the Cube.
        $query = $this->db->exec('UPDATE Setting SET Setting_Module = \'' . $moduleList . '\'WHERE RANK = 1');
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

            $query = $this->db->exec('UPDATE Setting SET Setting_OnModule = \'' . $onModule . '\'WHERE RANK = 1');
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

            $query = $this->db->exec('UPDATE Setting SET Setting_OnModule = \'' . $onModule . '\'WHERE RANK = 1');
            refresh();
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

    public function getOnModule(){
        $query = $this->db->query('SELECT Setting_OnModule FROM Setting');
        $query = $query->fetchArray(SQLITE3_ASSOC);
        return json_decode($query['Setting_OnModule']);  //Return array.
    }

    public function getStorageData(){
        $query = $this->db->query('SELECT * FROM Storage');
        $returnResult = [];
        while($result = $query->fetchArray(SQLITE3_ASSOC)) {
            $returnResult[] = $result;
        }
        return $returnResult;
    }

    //IMPORTANT!
    public function getAccountData(){
        $query = $this->db->query('SELECT * FROM Account');
        $query = $query->fetchArray(SQLITE3_ASSOC);
        return $query;  //Return array.
    }
    
}
<?php
//Find the user's own modules.
class ModuleFinder{

    private $moduleList;
    private $moudleDir = COREPATH . '/public/Module';

    private function findModule(){
        //ONLY find the user's modules.

        $dir_handle = opendir($this->moudleDir);

        while($filename = readdir($dir_handle)){
            if( ( $filename != "." ) && ( $filename != ".." ) ){
                $subFile = $this->moudleDir . DIRECTORY_SEPARATOR . $filename;
                //If the file is a dirction.
                if(is_dir($subFile)){ 
                    $this->moduleList[] = $filename;
                }
            }
        }
    }

    public function getModuleList(){
        $this->findModule();
        return $this->moduleList;
    }
}
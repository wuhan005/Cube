<?php
//Here is the base config of the Cube.
class Config {
    //Prevent to create an object.
    private function __construct(){}
    private function __clone(){}

    //Allow modules' to use $this->Load to load which type of file?
    public static $allowedFile = ['php', 'css', 'js'];

    //Database config.
    public static $DB_HOST = 'localhost';
    public static $DB_USER = 'root';
    public static $DB_PASSWORD = 'root';
    public static $DB_NAME = 'Cube';

}
<?php
namespace Configs;

class Database {
    const DATABASE = "corso_informatica";
    const HOST = "127.0.0.1";
    const TYPE = "mysql";
    const USERNAME = "admin";
    const PASSWORD = "admin";
            
    const CONNECT = self::TYPE.":dbname=".self::DATABASE.";host=".self::HOST;
}

// Configs\Database::CONNECT;
// Database::CONNECT;
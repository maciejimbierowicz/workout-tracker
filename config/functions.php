<?php 
session_start();
function get_connection(){
    $config = require 'config.php';
    return new PDO(
        $config['database_dsn'],
        $config['database_user'],
        $config['database_pass']
    );
};

?>
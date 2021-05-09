<?php
    define('host', 'localhost');
    define('db_user', 'root');
    define('db_pass', '');
    define('db_name', 'url_shortener');
    $db = mysqli_connect(host,db_user,db_pass,db_name);
    
    $base_url = "http://localhost/Url_Shortener";
?>
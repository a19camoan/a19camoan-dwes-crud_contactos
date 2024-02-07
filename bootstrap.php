<?php
    require "vendor/autoload.php";
    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    define("DBHOST", $_ENV["DBHOST"]);
    define("DBUSER", $_ENV["DBUSER"]);
    define("DBPASS", $_ENV["DBPASS"]);
    define("DBNAME", $_ENV["DBNAME"]);
    define("DBPORT", $_ENV["DBPORT"]);
    define("REDIRECT_URL", "Location: http://" . $_SERVER["HTTP_HOST"] . "/");

<?php

class Model
{
    public mysqli|false $con;
    protected string $dbLocation;
    protected string $username;
    protected string $password;
    protected string $dbName;


    function getData(string $query): array
    {
        $query = mysqli_query($this->con,$query);
        $result = [];
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    function update(string $query) {
        return mysqli_query($this->con,$query);
    }

    function __construct(){
        global $config;
        include("config.php");
        [
            'dbLocation' => $this->dbLocation,
            'dbUsername' => $this->username,
            'dbPassword' => $this->password,
            'dbDatabaseName' => $this->dbName
        ] = $config["db"];
        $this->con = mysqli_connect($this->dbLocation, $this->username, $this->password);

        mysqli_select_db($this->con, $this->dbName);
        mysqli_query($this->con, "SET NAMES 'utf8'");
    }

}
<?php
class DB {

    private static $db 		= false;
    private static $mysqli 	= false;

    function DB($address, $user, $password, $dbname) {
        self::$db = &$this;
        list($host, $port) = explode(':', $address);

        $mysqli = new mysqli($host, $user, $password, $dbname, $port);

        if ($mysqli->connect_error)
            throw new Exception("Connect failed: %s", $mysqli->connect_error);

        self::$mysqli = &$mysqli;
        self::$mysqli->query('SET NAMES utf8 COLLATE utf8_general_ci');
    }

    public static function GetRows($rows, $single = false) {
        $result = array();

        if ($rows === false)
            return $result;

        if ($single)
            return $rows->fetch_assoc();

        while ($row = $rows->fetch_assoc())
            array_push($result, $row);

        $rows->free();
        return $result;
    }

    public static function Select($sql, $single = false) {
        $result = self::$mysqli->query($sql);
        return self::$db->GetRows($result, $single);
    }

    public static function Update($data, $table, $where) {
        $sets = '';
        foreach ($data as $column => $value) {
            $sets .= $sets ? ', ' : '';
            $sets .= "`$column` = '$value'";
        }
        $sql = "UPDATE $table SET $sets WHERE $where";
        self::$mysqli->query($sql);
    }

    public static function Insert($data, $table) {
        $columns 	= "";
        $values 	= "";
        foreach ($data as $column => $value) {
            $columns 	.= $columns ? ', ' : '';
            $columns 	.= "`$column`";
            $values 	.= $values 	? ', ' : '';
            $values 	.= "'$value'";
        }
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        self::$mysqli->query($sql);
        return self::$mysqli->insert_id;
    }



    public static function Query($sql) {
        return self::$mysqli->query($sql);
    }

    public static function Delete($table, $where) {
        $sql = "DELETE FROM $table WHERE $where";
        self::$mysqli->query($sql);
    }

    public static function Close() {
        self::$mysqli->close();
    }

    function __destruct() {
        self::$db->Close();
    }




}
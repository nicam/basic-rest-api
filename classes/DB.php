<?php

class DB {
    private static $db = null;

    /**
     * Die $db wird sogenannt "lazy" initialisiert
     * @return PDO eine offene PDO Datenbank-Verbindung
     */
    public static function get() {

        //im ersten Durchgang ist $db noch null. Also wird initialisiert
        if (DB::$db == null) {
            $servername = "127.0.0.1";
            $db_name = "festivallovers";
            $username = "root";
            $password = "root";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //das Resultat der Initialisierung wird hier in die statische Variable gespeichert
                DB::$db = $conn;
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return DB::$db;
    }
}


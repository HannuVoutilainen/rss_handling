<?php
class db {
    public function openConnection($dbhost, $dbname, $dbuser, $dbpassword) {
        $conneciton = new PDO($dbhost, db);
    }
}
?>
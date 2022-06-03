<?php

    class Connection {
        private static $connection;

        public static function getConnection($dbhost, $dbName, $dbuser, $dbpass) {
            if (empty(Connection::$connection)) {
                Connection::$connection = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbName, $dbuser, $dbpass);
                Connection::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                Connection::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }

            return Connection::$connection;
        }
    }
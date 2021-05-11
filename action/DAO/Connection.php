<?php

    class Connection {
        private static $connection;

        public static function getConnection() {
            if (empty(Connection::$connection)) {
                try{
                    Connection::$connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATANAME, DB_USER, DB_PASS);
                    Connection::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    Connection::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                }
                catch{
                    
                    // DBhost
                    $host = DB_HOST;
                    // Utilisateur authoriser à créer une base de donnée
                    $authorizedUser = "root"
                    $authorizedPass = DB_AUTHORIZEDPASS;
                    
                    // Les infos de l'utilisateur à utiliser la nouvelle base de donnée 
                    $user = DB_USER;
                    $pass = DB_PASS;

                    // Les infos de la nouvelle base de donnée
                    $db = DB_NAME;
                    $createDB = CREATE_DB;

                    try {
                        Connection::$connection = new PDO("mysql:host=" . DB_HOST , $authorizedUser , $authorizedPass);
                
                        Connection::$connection->exec("`$createDB`;
                                CREATE USER '$user'@'$host' IDENTIFIED BY '$pass';
                                GRANT ALL ON `$db`.* TO '$user'@'$host';
                                FLUSH PRIVILEGES;")
                        or die(print_r($dbh->errorInfo(), true));
                
                    }
                    catch (PDOException $e) {
                        var_dump("La base de donnée n'existe pas! Si vous voulez que le programme la crée automatiquement vous devez mettre le bon mot de passe pour l'utillisateur root");
                        die("DB ERROR: " . $e->getMessage());
                    }
                }
            }

            return Connection::$connection;
        }
    }
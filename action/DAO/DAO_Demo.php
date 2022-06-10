<?php  
    require_once("action/DAO/Connection.php");
    require_once("action/Constants.php");

    class DAO_Demo {
        private static function connection(){
            $connection = Connection::getConnection(DB_USERPASS_HOST, DB_USERPASS, DB_USERPASS_USER, DB_USERPASS_PASS);
            return $connection;
        }

        public static function getAllUSERPASS(){
        
            $statement = DAO_Demo::connection()->prepare(GET_ALL_USER_PASSWORD);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            
            return $statement->fetchall();
        }

        public static function getUserPass($username, $password){

            $statement = DAO_Demo::connection()->prepare(GET_USER_PASSWORD);
            $statement->bindParam(1, $username);
            $statement->bindParam(2, $password);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            
            $data = $statement->fetch();
            return $data;
        }

        public static function addUser($username, $password, $visibility){
            $username = password_hash($username, PASSWORD_DEFAULT);
            $password = password_hash($password, PASSWORD_DEFAULT);

            $statement = DAO_Demo::connection()->prepare(ADD_USER);
            $statement->bindParam(1, $username);
            $statement->bindParam(2, $password);
            $statement->bindParam(3, $visibility);
            return $statement->execute();

        }
               
        
    }
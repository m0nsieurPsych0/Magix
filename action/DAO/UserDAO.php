<?php
    require_once("action/DAO/Connection.php");

    class UserDAO {

        public static function authenticate($username, $password) {
            $connection = Connection::getConnection();

            $statement = $connection->prepare("SELECT * FROM users WHERE username = ?");
            $statement->bindParam(1, $username);
            $statement->setFetchMode(PDO::FETCH_ASSOC); // <-- Permet de retourner un dictionnaire, ex: $row["username"], au lieu de $row[1]
            $statement->execute();

            $user = null;

            // $tableauDeLignes = $statement->fetchAll();
            if ($row = $statement->fetch()) {
                if (password_verify($password, $row["password"])) {
                    $user = $row; // $row["username"], $row["id"]
                }
            }

            return $user;
        }

        public static function updateProfile($user) {
            $connection = Connection::getConnection();
        }
    }
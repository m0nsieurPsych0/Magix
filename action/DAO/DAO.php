<?php  
    require_once("action/DAO/Connection.php");

    class DAO {
        private static function connection(){
            $connection = Connection::getConnection();
            $connection->exec(CREATE_TAB_ARTICLE);
            $connection->exec(CREATE_TAB_COMMENT);

            return $connection;
        }

        public static function addArticle($auteur, $titre, $contenu){

            $statement = DAO::connection()->prepare(ADD_ARTICLE);
            $statement->bindParam(1, $auteur);
            $statement->bindParam(2, $titre );
            $statement->bindParam(3, $contenu);
            $statement->execute();
        }
        
        public static function getArticle($id){
            $intId = $id['id'];

            $statement = DAO::connection()->prepare(GET_ARTICLE);
            $statement->bindParam(1, $intId);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
           
            $data = []; 
            $data['article'] = $statement->fetch();
            $data['comment'] = DAO::getComment($intId);
            return $data; 
        }

        public static function getAllArticle(){
        
            $statement = DAO::connection()->prepare(GET_ALL_ARTICLE);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            
            return $statement->fetchall();
        }

        public static function getLatest(){

            $statement = DAO::connection()->prepare(GET_LATEST);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            $data = $statement->fetch();
            // var_dump($data);
           return DAO::getArticle($data);
            
        }

        public static function modArticle($id, $titre, $contenu){

            $statement = DAO::connection()->prepare(MOD_ARTICLE);
            $statement->bindParam(1, $id);
            $statement->bindParam(2, $titre );
            $statement->bindParam(3, $contenu);
            $statement->execute();
        }

        public static function delArticle($articleid){
            
            $statement = DAO::connection()->prepare(DEL_ARTICLE);
            $statement->bindParam(1, $articleid);
            $statement->execute();
            DAO::delComment($articleid);
        }

        public static function addComment($auteur, $contenu, $articleId ){

            $statement = DAO::connection()->prepare(ADD_COMMENT);
            $statement->bindParam(1, $auteur);
            $statement->bindParam(2, $contenu );
            $statement->bindParam(3, $articleId );
            $statement->execute();
        }

        public static function getComment($articleId){

            $statement = DAO::connection()->prepare(GET_COMMENT);
            $statement->bindParam(1, $articleId);
            $statement->execute();
            return $statement->fetchAll();
        }

        public static function delComment($articleId){
            
            $statement = DAO::connection()->prepare(DEL_COMMENT);
            $statement->bindParam(1, $articleId);
            $statement->execute();
        }
        
    }
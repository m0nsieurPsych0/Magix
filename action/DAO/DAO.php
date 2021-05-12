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

            $statement = connection()->prepare(ADD_ARTICLE);
            $statement->bindParam(1, $auteur);
            $statement->bindParam(2, $titre );
            $statement->bindParam(3, $contenu);
            $statement->execute();
        }
        
        public static function getArticle($id){
            
            $statement = connection()->prepare(GET_ARTICLE);
            $statement->bindParam(1, $id);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            
            $data = [];
            $data['article'] = $statement->execute();
            $data['comment'] = getComment($id);

            return $data; 
        }

        public static function getLatest(){

            $statement = connection()->prepare(GET_LATEST);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            getArticle($statement->execute());
            
        }

        public static function modArticle($id, $titre, $contenu){

            $statement = connection()->prepare(MOD_ARTICLE);
            $statement->bindParam(1, $id);
            $statement->bindParam(2, $titre );
            $statement->bindParam(3, $contenu);
            $statement->execute();
        }

        public static function delArticle($articleid){
            
            $statement = connection()->prepare(DEL_ARTICLE);
            $statement->bindParam(1, $articleid);
            $statement->execute();
            delComment($articleid);
        }

        public static function addComment($auteur, $contenu, $articleId ){

            $statement = connection()->exec(ADD_COMMENT);
            $statement->bindParam(1, $auteur);
            $statement->bindParam(2, $contenu );
            $statement->bindParam(3, $articleId );
            $statement->execute();
        }

        public static function getComment($articleId){

            $statement = connection()->exec(GET_COMMENT);
            $statement->bindParam(1, $articleId);
            $statement->execute();
            return $statement->fetchAll();
        }

        public static function delComment($articleId){
            
            $statement = connection()->prepare(DEL_COMMENT);
            $statement->bindParam(1, $articleId);
            $statement->execute();
        }
        
    }
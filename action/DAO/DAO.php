<?php  
    require_once("action/DAO/Connection.php");

    class Article {
        $connection = Connection::getConnection();
        $connection->exec(CREATE_TAB_ARTICLE);

        public static function addArticle($auteur, $titre, $contenu){
            
            $statement = $connection->prepare(ADD_ARTICLE);
            $statement->bindParam(1, $auteur);
            $statement->bindParam(2, $titre );
            $statement->bindParam(3, $contenu);
            $statement->execute();
        }
        
        public static function getArticle($id){

            $statement = $connection->prepare(GET_ARTICLE);
            $statement->bindParam(1, $id);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            
        }

        public static function modArticle($id, $titre, $contenu){

            $statement = $connection->prepare(MOD_ARTICLE);
            $statement->bindParam(1, $id);
            $statement->bindParam(2, $titre );
            $statement->bindParam(3, $contenu);
            $statement->execute();
            
        }

        public static function delArticle($id){
            
            $statement = $connection->prepare(DEL_ARTICLE);
            $statement->bindParam(1, $id);
            $statement->execute();
            Comment::delComment($id);
        }


    }

    class Comment{
        $connection = Connection::getConnection();
        $connection->exec(CREATE_TAB_COMMENT);

        public static function insertComment($auteur, $contenu, $articleId ){

            $connection->exec(INSERT_COMMENT);
            $statement->bindParam(1, $auteur);
            $statement->bindParam(2, $contenu );
            $statement->bindParam(3, $articleId );
            $statement->execute();

        }
        public static function getComment($articleId){

            $connection->exec(GET_COMMENT);
            $statement->bindParam(1, $articleId);
            $statement->execute();
            return $statement->fetchAll();

        }
        public static function delComment($articleId){
            
            $statement = $connection->prepare(DEL_COMMENT);
            $statement->bindParam(1, $articleId);
            $statement->execute();
        }
        
    }
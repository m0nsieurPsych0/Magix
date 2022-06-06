<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/DAO.php");

    class GuideAction extends CommonAction {

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        }

        protected function executeAction() {
            $db = [];

            if(!empty($_POST)){
                //On prévient la ressoumission de formulaire
                if (!empty($_SESSION['oldpost'])){
                    if ($_SESSION['oldpost'] == $_POST){
                        unset($_POST);
                        unset($_SESSION['oldpost']);
                        header(GUIDE);
                        exit;
                    }
                }
                $_SESSION['oldpost'] = $_POST;
                if (isset($_POST["article"])){

                    if(isset($_POST['add'])){
                        if(isset($_POST['contenu']) && isset($_POST['titre']) && $_SESSION["visibility"]>=VISIBILITY_MODERATOR){
                            DAO::addArticle($_SESSION['username'], $_POST['titre'], $_POST['contenu']);
                        }
                    }
                    elseif(isset($_POST['mod']) && $_SESSION["visibility"]>=VISIBILITY_MODERATOR){
                        if(isset($_POST['articleId'], $_POST['titre'], $_POST['contenu'])){
                            DAO::modArticle($_POST['titre'], $_POST['contenu'], $_POST['articleId']);
                        }
                    }
                    elseif(isset($_POST['get'])){
                        if(isset($_POST['articleId'])){
                            $db["article"] = DAO::getArticle($_POST['articleId']);
                        }
                    }
                    elseif(isset($_POST['del']) && $_SESSION["visibility"]>=VISIBILITY_MODERATOR){
                        if(isset($_POST['articleId'])){
                            DAO::delArticle($_POST['articleId']);
                        }
                    }
                }
                elseif(isset($_POST["comment"])){
                    if(isset($_POST['add']) && $_SESSION["visibility"]>=VISIBILITY_MEMBER){
                        if(isset($_POST['auteur']) && isset($_POST['contenu']) && isset($_POST['articleId'])){
                            //Substring de 40chars pour satisfaire la limite de la base de donnée
                            DAO::addComment(substr($_POST['auteur'], 0, 39), $_POST['contenu'], $_POST['articleId']); 
                            $db["article"] = DAO::getArticle($_POST['articleId']);
                        }
                    }
                    else{
                        $db["article"] = DAO::getArticle($_POST['articleId']);
                    }
                }

            }
            // Si aucun article dans la variable 'db' on va chercher le plus récent
            if(!isset($db["article"])){
                $db["article"] = DAO::getLatest();
            }
            
            $db["articleList"] = DAO::getAllArticle();
            return compact("db");

        }
    }
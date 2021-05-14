<?php
    require_once("action/CommonAction.php");
    // require_once("action/DAO/UserDAO.php");

    class LoginAction extends CommonAction {

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        }

        protected function executeAction() {
            $hasConnectionError = false;
            // Si on entre le url login.php et qu'on a déjà été identifié par l'API.
            // On redirige a home.php
            if(isset($_SESSION['key'])){
                header(HOME);
                exit;
            }
            // Previent de resoumettre les mêmes données lorsqu'on rafraîchit la page
            // Et d'afficher le message d'erreur pour les même données erronées.
            if (!empty($_SESSION['oldpost'])){
                if ($_SESSION['oldpost'] == $_POST){
                    unset($_POST);
                    unset($_SESSION['oldpost']);
                    header(LOGIN);
                    exit;
                }
            }
            if (!empty($_POST["username"]) || !empty($_POST["password"])){
                $result = parent::callAPI("signin", $_POST);
                
                if ($result == "INVALID_USERNAME_PASSWORD") {                    
                    $_SESSION['oldpost'] = $_POST;
                    $hasConnectionError = true;
                }
                else {
                    // On ajoute la clef API à la variable de session
                    $_SESSION["username"] = $_POST["username"];
					$_SESSION["visibility"] = CommonAction::$VISIBILITY_MEMBER;
                    $_SESSION["key"] = $result->key;
                    unset($_SESSION['oldpost']);
                    header(HOME);
                    exit;
                }
            }
            
            return compact("hasConnectionError");
               
        }
    }
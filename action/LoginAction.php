<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/DAO_Demo.php");

    class LoginAction extends CommonAction {

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        }

        protected function localAuth($username, $password){
            $data = DAO_Demo::getAllUSERPASS();
            $currentUser = [];

            foreach ($data as $content) {
                if(password_verify($username, $content['username']) && password_verify($password, $content['password'])){
                    $currentUser["username"] = $username;
                    $currentUser["visibility"] = $content["visibility"];
                    return $currentUser;
                }
            }
            return false;
        }

        protected function apiAuth($currentUser){

            $localPost["username"] = getenv("API_USER");
            $localPost["password"] = getenv("API_PASSWORD");
            // $result = parent::callAPI("signin", $_POST);
            $result = parent::callAPI("signin", $localPost);

            if ($result == "INVALID_USERNAME_PASSWORD") {                    
                $_SESSION["oldpost"] = $_POST;
                $hasConnectionError = true;
            }
            else {
                // On ajoute la clef API à la variable de session
                $_SESSION["username"] = $currentUser["username"];
                $_SESSION["visibility"] = $currentUser["visibility"];
                // $_SESSION["visibility"] = CommonAction::$VISIBILITY_MEMBER;
                $_SESSION["key"] = $result->key;
                unset($_SESSION["oldpost"]);
                header(HOME);
                exit;
            }
        }
        
        protected function executeAction() {
            $hasConnectionError = false;
            // Si on entre le url login.php et qu'on a déjà été identifié par l'API.
            // On redirige a home.php
            if(isset($_SESSION["key"])){
                header(HOME);
                exit;
            }
            // Previent de resoumettre les mêmes données lorsqu'on rafraîchit la page
            // Et d'afficher le message d'erreur pour les même données erronées.
            if (!empty($_SESSION["oldpost"])){
                if ($_SESSION["oldpost"] == $_POST){
                    unset($_POST);
                    unset($_SESSION["oldpost"]);
                    header(LOGIN);
                    exit;
                }
            }
            if (!empty($_POST["username"]) || !empty($_POST["password"])){
                $localResult = LoginAction::localAuth($_POST["username"], $_POST["password"]);

                if($localResult != false){
                    LoginAction::apiAuth($localResult);
                }
                else{
                    $_SESSION["oldpost"] = $_POST;
                    $hasConnectionError = true;
                }
                
            }
            
            return compact("hasConnectionError");
               
        }
    }
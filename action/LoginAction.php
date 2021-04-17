<?php
    require_once("action/CommonAction.php");
    // require_once("action/DAO/UserDAO.php");

    class LoginAction extends CommonAction {

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        }

        protected function executeAction() {
            $hasConnectionError = false;
            
            if (isset($_POST["username"])){
                $result = parent::callAPI("signin", $_POST);
                
                if ($result == "INVALID_USERNAME_PASSWORD") {
                    // err
                    $_POST = array(); 
                    $hasConnectionError = true;
                }
                else {
                    $_SESSION["username"] = $_POST["username"];
					$_SESSION["visibility"] = 1;
                    $_SESSION["key"] = $result->key;
                    header("location:home.php");
                    exit;
                }
            }
            
            return compact("hasConnectionError");
               
        }
    }
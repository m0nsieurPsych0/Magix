<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/UserDAO.php");

    class LoginAction extends CommonAction {

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
        }

        protected function executeAction() {
            $hasConnectionError = false;

            $data = [];
            $data["username"] = "Falcor";
            $data["password"] = "AAAaaa111";
    
            $result = parent::callAPI("signin", $data);
    
            if ($result == "INVALID_USERNAME_PASSWORD") {
                // err
            }
            else {
                // Pour voir les informations retournées : var_dump($result);exit;
                $key = $result->key;
            }
        }
    }
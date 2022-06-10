<?php
    require_once("action/CommonAction.php");
    require_once("action/DAO/DAO_Demo.php");

    class AdminAction extends CommonAction {

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_ADMINISTRATOR);
        }

        protected function executeAction() {
            
            if (!empty($_POST["username"]) || !empty($_POST["password"]) || !empty($_POST["visibility"])){
                
                try{
                    DAO_Demo::addUser($_POST["username"], $_POST["password"], $_POST["visibility"]);
                }
                catch (PDOEXCEPTION $error){
                    $hasConnectionError = true;
                    return compact("hasConnectionError");
                }
            }
            
        }
    }
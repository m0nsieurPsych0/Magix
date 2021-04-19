<?php
    session_start();
    require_once("action/constants.php");

    abstract class CommonAction {
        protected static $VISIBILITY_PUBLIC = 0;
        protected static $VISIBILITY_MEMBER = 1;
        protected static $VISIBILITY_MODERATOR = 2;
        protected static $VISIBILITY_ADMINISTRATOR = 3;
        private $pageVisibility;

        public function __construct($pageVisibility) {
            $this->pageVisibility = $pageVisibility;
        }
        
        // Se connecter à l'API de MAGIX
        public function callAPI($service, array $data) {
            $apiURL = "https://magix.apps-de-cours.com/api/" . $service;

            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $result = file_get_contents($apiURL, false, $context);
            // !== false ou == true
            if (strpos($result, "<br") == true) {
                var_dump($result);
                exit;
            }
            
            return json_decode($result);
        }

        public function checkSession($data) {
            // Vérifie si on veut logout OU si la clef API est toujours valide
			if (!empty($_GET["logout"]) || CommonAction::callAPI("games/state", $data) == "INVALID_KEY") {
                if(isset($_SESSION["key"])){
                    CommonAction::callAPI("signout", $data);
                }
                session_unset();
                session_destroy();
                session_start();
				header(LOGIN);
				exit;
            }
        }

        public function execute() {
                          
            if (empty($_SESSION["visibility"])) {
                $_SESSION["visibility"] = CommonAction::$VISIBILITY_PUBLIC; // Un guest (usager non connecté)
            }

            if ($_SESSION["visibility"] < $this->pageVisibility) {
				header(LOGIN);
				exit;
            }

            // Design pattern (une solution reconnue pour un problème courant)
            // Template method
            $data = $this->executeAction();
            $data["isLoggedIn"] = $_SESSION["visibility"] > CommonAction::$VISIBILITY_PUBLIC;
            $data["username"] = !empty($_SESSION["username"]) ? $_SESSION["username"] : "Invité";
            return $data;
        }

        protected abstract function executeAction();


    }
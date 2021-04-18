<?php
    require_once("action/CommonAction.php");

    class GameAction extends CommonAction {

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_MEMBER);
        }
        protected function executeAction() {

            // check si on joue pvp ou on s'entraîne (pve)
            $data = [];
            $data["key"] = $_SESSION["key"];


            $result = parent::callAPI("games/auto-match", $data);

            return [];
        }

        protected function jouer(){
            
        }
        protected function pratiquer(){

        }
    }
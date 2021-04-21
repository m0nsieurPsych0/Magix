<?php
    require_once("action/CommonAction.php");

    class AjaxAction extends CommonAction {

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_MEMBER);
        }
        protected function executeAction() {
            $result = parent::callAPI("games/state", array("key" => $_SESSION["key"]));
            
            return compact("result");
        }

    }
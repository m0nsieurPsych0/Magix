<?php
    require_once("action/CommonAction.php");

    class AjaxAction extends CommonAction {

        public function __construct() {
            parent::__construct(CommonAction::$VISIBILITY_MEMBER);
        }
        protected function executeAction() {
            // GAME ACTION //
            if (isset($_POST["type"])){
                $data["key"] = $_SESSION["key"];
                $data["type"] = $_POST["type"];
                
                if(isset($_POST["uid"])){
                    $data["uid"] = $_POST["uid"];
                }

                if(isset($_POST["targetuid"])){
                    $data["targetuid"] = $_POST["targetuid"];
                }

                $result = parent::callAPI("games/action", $data);
                
                foreach (ERRORGAME as $error){
                    if ($result == $error){
                        $def = ERRORGAMEDEF["error"];
                        return compact("def");
					}
                    else{
                        return compact("result");
                    }
				}

            }
            // GAME STATE //
            else{
                $result = parent::callAPI("games/state", array("key" => $_SESSION["key"]));

                return compact("result");
            }
            
        }

    }
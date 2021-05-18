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
                
                return compact("result");

            }
            // OBSERVE //
            elseif(isset($_SESSION["observe"])){

                $result = parent::callAPI("games/observe", array("key" => $_SESSION["key"], "username" => $_SESSION["observe"]));

                if($result == "NOT_IN_GAME" && $_SESSION["firstCall"] == true){
                    return compact("result");
                }
                elseif($result == "NOT_IN_GAME" && $_SESSION["firstCall"] == false){
                    // Workaround pour être capable d'afficher l'état de la partie observée //
                    // Comme on ne reçoit en réponse que "NOT_IN_GAME" à la fin d'une partie, 
                    // on ne sait pas si la personne qu'on regardait a gagné ou non.
                    // Donc on va chercher ses stats dans "users-extra" et on renvoit à game.js en tant que donnée ajax.
                    $newData["allUsers"] = false;
                    $newData["key"] = $_SESSION["key"];
			        $resultbrut = parent::callAPI("users-extra", $newData);
			        $result = $resultbrut->users;
			
			        foreach($result as $content){
                        if(isset($content->username)){
                            if($content->username == $_SESSION["observe"]){
                                $result = $content->lastGameState;
                                return compact("result");
                            }
                        }
                    }
                }
                else{
                    $_SESSION["firstCall"] = false;
                    return compact("result");
                }
            }
            // GAME STATE //
            else{
                $result = parent::callAPI("games/state", array("key" => $_SESSION["key"]));
                return compact("result");
            }
            
        }

    }
<?php
	require_once("action/CommonAction.php");

	class HomeAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER);
		}
		
		protected function executeAction() {
			$data = [];
			$data["key"] = $_SESSION["key"];

			// Vérifie si on veut logout OU si la clef API est toujours valide
			if (!empty($_GET["logout"]) || parent::callAPI("games/state", $data) == "INVALID_KEY") {
                if(isset($_SESSION["key"])){
                    parent::callAPI("signout", $data);
                }
                session_unset();
                session_destroy();
                session_start();
				header(LOGIN);
				exit;
            }
			
			// on démarre le match en fonction du type voulu (soit PVP ou PVE(TRAINING))
			if(!empty($_GET)){
				//call api
				if (isset($_GET["pvp"])){
					$data["type"] = "PVP";
				}
				else {
					$data["type"] = "TRAINING";
				}

				$result = parent::callAPI("games/auto-match", $data);

				if($result == "INVALID_KEY" || $result == "INVALID_GAME_TYPE"){
					
				}
				elseif($result == "DECK_INCOMPLETE"){

				}
				elseif ($result == "MAX_DEATH_THRESHOLD_REACHED"){

				}
				$_SESSION["gameType"] = $result;
				header(GAME);
                exit;
            }
		
		}

	
	}
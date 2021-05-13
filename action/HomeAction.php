<?php
	require_once("action/CommonAction.php");

	class HomeAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_MEMBER);
		}
		
		protected function executeAction() {
			$hasConnectionError = false;
			$data = [];
			$data["key"] = $_SESSION["key"];

			// Vérifie si on veut déconnecter ou si la clef est expiré
			parent::checkSession($data);
			
			// on démarre le match en fonction du type voulu (soit PVP ou PVE(TRAINING))
			if(!empty($_GET)){
				//call api
				if (isset($_GET["pvp"])){
					$data["type"] = "PVP";
					$result = parent::callAPI("games/auto-match", $data);
				}
				elseif (isset($_GET["pve"])){
					$data["type"] = "TRAINING";
					$result = parent::callAPI("games/auto-match", $data);
				}
				// elseif((isset($_GET["observe"]))){
				// 	$data["username"] = "";
				// 	$result = parent::callAPI("games/observe", $data);
				// }



				foreach (ERRORCODES as $error){
					if ($result == $error){
						$hasConnectionError = true;
						return compact("hasConnectionError", "error");
					}
				}
				
				$_SESSION["gameType"] = $result;
				header(GAME);
                exit;
            }
			
			// User history
			$data["allUsers"] = false;
			$resultbrut = parent::callAPI("users-extra", $data);
			$result = $resultbrut->users;
			
			foreach($result as $content){
				if(isset($content->username)){
					if($content->username == $_SESSION["username"]){

						$info['Dernière Connexion: '] = $content->lastLogin;
						if($content->lastGameState == "LAST_GAME_LOST"){
							$info['Dernière Partie: '] = "Perdue";
						}
						else{
							$info['Dernière Partie: '] = "Gagnée";
						}
						$info['Parties Gagnées: '] = $content->winCount;
						$info['Parties Perdues: '] = $content->lossCount;
						$info['Trophés: '] = $content->trophies;
						return compact("info");

					}
				}
			}

		}

	
	}
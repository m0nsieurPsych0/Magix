<?php
    require_once("action/LoginAction.php");

    $action = new LoginAction();
    $data = $action->execute();
	$page = "login";
	require_once("partial/header.php");
?>
			<main>
				<div class="login-form-frame">
					<!-- autocomplete à «off» pour simuler une fenêtre de terminal -->
					<!-- Mais le dernier username qui s'est authentifé avec succès est sauvegardé dans localStorage -->
					<form action="login.php" method="post" autocomplete="off"> 
												
						<div class="form-label">
							<label for="username">Nom d'usager : </label>
						</div>

						<div class="form-input">
							<input type="text" name="username" id="username"/>
						</div>
						<div class="form-separator"></div>

						<div class="form-label">
							<label for="password">Mot de passe : </label>
						</div>
						
						<div class="form-input">
							<input type="password" name="password" id="password"/>
						</div>
						<div class="form-separator"></div>

						<div class="form-input">
							<button type="submit" ></button>
						</div>
						<div class="form-separator"></div>
					</form>
					<?php
							if ($data["hasConnectionError"]){
								?><div class="error-div"> Erreur de connexion </div><?php
							}
						?>
				</div>
				
			</main>
		

<?php
	require_once("partial/footer.php");   


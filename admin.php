<?php
    require_once("action/AdminAction.php");

    $action = new AdminAction();
    $data = $action->execute();
    $page = "admin";
    
    require_once("partial/header.php");
?>

            <main>
                <form action="admin.php" method="post" autocomplete="new-password"> 
												
                    <div class="form-label">
                        <label for="username">Nom d'usager à ajouter : </label>
                    </div>

                    <div class="form-input">
                        <input type="text" name="username" id="username" autocomplete="new-password" required/>
                    </div>
                    <div class="form-separator"></div>
                    <div class="form-label">
                        <label for="password">Mot de passe à associé : </label>
                    </div>
                    
                    <div class="form-input">
                        <input type="password" name="password" id="password" autocomplete="new-password" required/>
                    </div>
                    <div class="form-separator"></div>

                    <div class="form-label">
                        <label for="visibility">Visibilité de l'usager : </label>
                    </div>
                    
                    <div class="form-input">
                        <input type="text" name="visibility" id="visibility" value="1" autocomplete="new-password" required/>
                    </div>
                    <div class="form-separator"></div>

                    <div class="form-input">
                        <label for="submit"> confirm the action</label>
                        <input type="checkbox" id="confirmation" name="confirmation" required>
                    </div>                    

                    <div class="form-input">
                        <button type="submit" ></button>
                    </div>
                </form>
                <?php
						if (isset($data["hasConnectionError"]) && $data["hasConnectionError"]){
							?><div class="error-div"> Erreur de connexion </div><?php
						}
						?>
            </main>

<?php
	require_once("partial/footer.php");
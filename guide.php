<?php
    require_once("action/GuideAction.php");

    $action = new GuideAction();
    $data = $action->execute();
    $page = "guide";
    
    require_once("partial/header.php");
    
    // var_dump($_SESSION);

?>
                <main>
                    <div id="articles">
                                                
                        <template id="template-article">
                            <h1 id="titre"></h1>
                            <div id="auteur-date-wrapper">
                                <div id="auteur-article"></div>
                                <div id="date-article"></div>
                            </div>
                            <div id="contenu"></div>
                        </template>
                        <div id="template-article">
                            <h1 id="titre">LoremIpsum</h1>
                            <div id="auteur-date-wrapper">
                                <div id="auteur-article">Karl drogo</div>
                                <div id="date-article"> 10 avril 2020</div>
                            </div>
                            <div id="contenu">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ipsa quis sit ratione, fugiat quas voluptas est iste unde quisquam magni culpa! Earum vero similique quam, optio soluta mollitia doloremque?
                            Sint labore quam ipsa voluptate provident, delectus dolorum inventore qui maiores reiciendis, necessitatibus possimus natus. Aliquid velit at consequuntur sunt doloribus voluptas nisi tenetur amet quos? Tenetur modi omnis quis.
                            Laboriosam perferendis debitis saepe natus, porro, optio voluptatum rerum quidem fugit nam doloribus iste repellendus id! Sunt explicabo non quidem reiciendis iste, provident maxime deserunt corporis repellendus omnis recusandae possimus!
                            Alias nesciunt ratione aspernatur, atque, sint dignissimos quasi perferendis non deserunt facilis eveniet dolore corporis, impedit nostrum nam tenetur. Eum suscipit consequuntur, debitis facere nobis animi dolorem nostrum quis voluptas.</div>
                        </div>

                        <div id="ajout-commentaire">
                            <form action="guide.php" method="post" autocomplete="off">
                                <textarea id="ajout-auteur"  placeholder="Votre nom" name="auteur"></textarea>
                                <textarea id="ajout-contenu" placeholder="Votre commentaire" name="contenu"></textarea>
                                <button id="envoyer">Envoyer</button>
                            </form>
                        </div>
                        
                        <template id="template-commentaire">
                            <div class="commentaire-wrapper">
                                    <div class="auteur-date-wrapper">
                                        <div class="auteur-commentaire"></div>
                                        <div class="date-commentaire"></div>
                                    </div>
                                <div class="contenu-commentaire"></div>
                            </div>
                        </template>
                        
                            
                    
                    </div>
                    
                    <div id="historique">historique</div>
                    <!-- Pour chaque année en ordre décroissante -->
                    <!-- Pour chaque article en ordre antéchronologique-->
                </main>
<?php
	require_once("partial/footer.php");
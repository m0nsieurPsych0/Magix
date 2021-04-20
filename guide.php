<?php
    require_once("action/GuideAction.php");

    $action = new GuideAction();
    $data = $action->execute();
    $page = "guide";
    
    require_once("partial/header.php");
    //test
    
    // var_dump($_SESSION);

?>
                <main>
                    <div>Guide</div>
                </main>
<?php
	require_once("partial/footer.php");
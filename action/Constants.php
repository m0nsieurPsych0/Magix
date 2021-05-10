<?php
    /********************************* API *********************************/
    // Chat
    define("CHATURL", "https://magix.apps-de-cours.com/server/#/chat/");
    define("DECKMASTER","https://magix.apps-de-cours.com/server/#/deck/");
    //API call

    //API errors
    define("ERRORCODES", ["INVALID_KEY", "INVALID_GAME_TYPE", "DECK_INCOMPLETE", "MAX_DEATH_THRESHOLD_REACHED"]);
    define("ERRORGAME", ["INVALID_ACTION", "ACTION_IS_NOT_AN_OBJECT", "NOT_ENOUGH_ENERGY", "BOARD_IS_FULL", "CARD_NOT_IN_HAND", "CARD_IS_SLEEPING", "MUST_ATTACK_TAUNT_FIRST", "OPPONENT_CARD_NOT_FOUND", "OPPONENT_CARD_HAS_STEALTH", "CARD_NOT_FOUND", "ERROR_PROCESSING_ACTION", "INTERNAL_ACTION_ERROR", "HERO_POWER_ALREADY_USED"]);
    
    /****************************** redirect ******************************/
    // Pas nécessaire du tout, fait pour tester les constantes
    define("HOME", "location:home.php");
    define("LOGIN", "location:login.php");
    define("INDEX", "location:index.php");
    define("GAME", "location:game.php");

    /****************************** MY_SQL ******************************/

    define("DB_HOST", "localhost");
    define("DB_DATABASE", "magix_os_db");
    define("DB_USER", "magix_user");
    define("DB_PASS", "AAAaaa111");
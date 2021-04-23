<?php
    /********************************* API *********************************/
    // Chat
    define("CHATURL", "https://magix.apps-de-cours.com/server/#/chat/");
    //API call

    //API errors
    define("ERRORCODES", ["INVALID_KEY", "INVALID_GAME_TYPE", "DECK_INCOMPLETE", "MAX_DEATH_THRESHOLD_REACHED"]);
    define("ERRORGAME", ["INVALID_ACTION", "ACTION_IS_NOT_AN_OBJECT", "NOT_ENOUGH_ENERGY", "BOARD_IS_FULL", "CARD_NOT_IN_HAND", "CARD_IS_SLEEPING", "MUST_ATTACK_TAUNT_FIRST", "OPPONENT_CARD_NOT_FOUND", "OPPONENT_CARD_HAS_STEALTH", "CARD_NOT_FOUND", "ERROR_PROCESSING_ACTION", "INTERNAL_ACTION_ERROR", "HERO_POWER_ALREADY_USED"]);
    
    define("ERRORGAMEDEF", ["INVALID_ACTION" => "Action invalide", "ACTION_IS_NOT_AN_OBJECT" => "Mauvaise structure de données", "NOT_ENOUGH_ENERGY" => "La carte coûte trop cher à jouer", "BOARD_IS_FULL" => "Pas assez de place pour la carte", "CARD_NOT_IN_HAND" => "La carte n’est pas dans votre main", "CARD_IS_SLEEPING" => "Carte ne peut être jouée ce tour-ci", "MUST_ATTACK_TAUNT_FIRST" => "Une carte taunt empêche ce coup", "OPPONENT_CARD_NOT_FOUND" => "La carte attaquée n’est pas présente sur le jeu", "OPPONENT_CARD_HAS_STEALTH" => "La carte ne peut être attaquée directement tant qu’elle possède « stealth »", "CARD_NOT_FOUND" => "La carte cherchée (uid) n’est pas présente", "ERROR_PROCESSING_ACTION" => "Erreur interne, ne devrait pas se produire", "INTERNAL_ACTION_ERROR" => "Autre erreur interne, ne devrait pas se produire", "HERO_POWER_ALREADY_USED" => "Pouvoir déjà utilisé pour ce tour"]);
    /****************************** redirect ******************************/
    // Pas nécessaire du tout, fait pour tester les constantes
    define("HOME", "location:home.php");
    define("LOGIN", "location:login.php");
    define("INDEX", "location:index.php");
    define("GAME", "location:game.php");
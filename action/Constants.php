<?php
    /********************************* API *********************************/
    // iframe
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
    define("DB_NAME", "c55_db");
    define("DB_USER", "c55_user");
    define("DB_PASS", "AAAaaa111");
    define("DB_AUTHORIZEDPASS", "");

    // Manipulation base de donnée MySQL
    define("CREATE_DB", "CREATE DATABASE IF NOT EXISTS magix_os_db");

    // ARTICLE
    define("CREATE_TAB_ARTICLE", "CREATE TABLE IF NOT EXISTS `article` (
        `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `auteur` varchar(40) NOT NULL,
        `titre` varchar(100) NOT NULL,
        `contenu` text NOT NULL,
        `creation_time` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `modification_time` DATETIME ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");
    
    // QUERY ARTICLE
    define("ADD_ARTICLE", "INSERT INTO `article` (`auteur`, `titre`, `contenu`) VALUES(?, ?, ?)");
    define("GET_ARTICLE", "SELECT * FROM `article` WHERE (`id`) = ?");
    define("GET_ALL_ARTICLE", "SELECT * FROM `article` ORDER BY `creation_time` DESC limit 1");
    define("MOD_ARTICLE", "UPDATE `article` SET (`id`, `titre`, `contenu`) VALUE(?)");
    define("DEL_ARTICLE", "DELETE `comment` WHERE (`id`) = ?");
    define("GET_LATEST", "SELECT `id` FROM `article` ORDER BY `creation_time` DESC limit 1");
    
    // COMMENT
    define("CREATE_TAB_COMMENT", "CREATE TABLE IF NOT EXISTS `comment` (
        `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `id_article` int(10) NOT NULL REFERENCES `article` (`id`),
        `auteur` varchar(40) NOT NULL,
        `contenu` text NOT NULL,
        `creation_time` DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`,`id_article`) 
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

    // QUERY COMMENT
    define("ADD_COMMENT", "INSERT INTO `comment` (`auteur`,`contenu`,`id_article`) VALUES(?, ?, ?)");
    define("GET_COMMENT", "SELECT * FROM `comment` WHERE `id_article` = ?");
    define("DEL_COMMENT", "DELETE * FROM `comment` WHERE `id_article` = ?");
  
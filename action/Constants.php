<?php

    /****************************** Visibility ******************************/
    define("VISIBILITY_PUBLIC", 0);
    define("VISIBILITY_MEMBER", 1);
    define("VISIBILITY_MODERATOR", 2);
    define("VISIBILITY_ADMINISTRATOR", 3);

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
    define("GUIDE", "location:guide.php");

    /****************************** MY_SQL ******************************/
    // PHP VARIABLES:
    // SetEnv ARTICLE_DB_HOST 
    // SetEnv ARTICLE_DB_NAME 
    // SetEnv ARTICLE_DB_USER 
    // SetEnv ARTICLE_DB_PASS 
    // SetEnv USERPASS_DB_HOST
    // SetEnv USERPASS_DB_NAME
    // SetEnv USERPASS_DB_USER
    // SetEnv USERPASS_DB_PASS

    // Article
    define("DB_ARTICLE_HOST", getenv("ARTICLE_DB_HOST"));
    define("DB_ARTICLE", getenv("ARTICLE_DB_NAME"));
    define("DB_ARTICLE_USER", getenv("ARTICLE_DB_USER"));
    define("DB_ARTICLE_PASS", getenv("ARTICLE_DB_PASS"));
    // Userpass
    define("DB_USERPASS_HOST", getenv("USERPASS_DB_HOST"));
    define("DB_USERPASS", getenv("USERPASS_DB_NAME"));
    define("DB_USERPASS_USER", getenv("USERPASS_DB_USER"));
    define("DB_USERPASS_PASS", getenv("USERPASS_DB_PASS"));



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
    define("GET_ALL_ARTICLE", "SELECT * FROM `article`ORDER BY COALESCE(`modification_time`, `creation_time`) DESC");

    define("MOD_ARTICLE", "UPDATE `article` SET `titre` = ?, `contenu` = ? WHERE `article`.`id` = ?");
    define("DEL_ARTICLE", "DELETE FROM `article` WHERE `article`.`id` = ?");
    define("GET_LATEST", "SELECT `id` FROM `article`ORDER BY COALESCE(`modification_time`, `creation_time`) DESC limit 1");
    
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
    define("DEL_COMMENT", "DELETE FROM `comment` WHERE `comment`.`id_article` = ?");
  
    // QUERY USER_PASSWORD
    define("GET_USER_PASSWORD", "SELECT * FROM `user_password` WHERE `username` = ? AND `password` = ?");
    define("GET_ALL_USER_PASSWORD", "SELECT * FROM `user_password`");
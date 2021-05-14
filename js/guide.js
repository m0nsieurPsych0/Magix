// Initialise une fonction qui va intercepter le retour en arrière du navigateur
// Lorsqu'on capte un retour en arrière on appel la fonction de vidéo 'exit' puis on retourne à home.php
((global) => {catchingBackButtonEvent(global);})(window);

const displayArticle = (dbData) => {

    let article = document.createElement("div");
    article.id = "article-wrapper";
    article.innerHTML = document.getElementById("template-article").innerHTML;
    document.getElementById("article").append(article);

    document.querySelector("h1").innerHTML = dbData.article.titre;
    document.getElementById("auteur-article").innerHTML = dbData.article.auteur;
    document.getElementById("date-article").innerHTML = dbData.article.creation_time;
    document.getElementById("contenu").innerHTML = dbData.article.contenu;

    commentCreation(dbData.article.id);
    displayComment(dbData.comment);

}

const displayComment = (comments) =>{
    let i = 0;
    comments.forEach(comment => {
        let commentElem = document.createElement("div");
        commentElem.className = "commentaire-wrapper";
        commentElem.innerHTML = document.getElementById("template-commentaire").innerHTML;
        document.getElementById("article").append(commentElem);
        
        document.getElementsByClassName("auteur-commentaire")[i].innerHTML = comment.auteur;
        document.getElementsByClassName("date-commentaire")[i].innerHTML = comment.creation_time;
        document.getElementsByClassName("contenu-commentaire")[i].innerHTML = comment.contenu;
        i++;
    });
}

const commentCreation = (articleId) =>{
    let commentCreation = document.createElement("form");
    commentCreation.id = "ajout-commentaire-wrapper";
    commentCreation.setAttribute("action", "guide.php");
    commentCreation.setAttribute("method", "post");
    commentCreation.setAttribute("autocomplete", "off");
    commentCreation.innerHTML = document.getElementById("template-ajout-commentaire").innerHTML;

    document.getElementById("article").append(commentCreation);
    
    document.getElementById("articleId-comment").setAttribute("value", articleId);
}

const createArticle = () =>{
    document.getElementById("article").innerHTML = "";

    let articleCreation = document.createElement("form");
    articleCreation.id = "creer-article-wrapper";
    articleCreation.setAttribute("action", "guide.php");
    articleCreation.setAttribute("method", "post");
    articleCreation.setAttribute("autocomplete", "off");
    articleCreation.innerHTML = document.getElementById("template-creer-article").innerHTML;
    
    document.getElementById("article").append(articleCreation);

}
const modifyArticle = (dbData) =>{
    console.log(dbData);
    document.getElementById("article").innerHTML = "";

    let modifyArticle = document.createElement("form");
    modifyArticle.id = "creer-article-wrapper";
    modifyArticle.setAttribute("action", "guide.php");
    modifyArticle.setAttribute("method", "post");
    modifyArticle.setAttribute("autocomplete", "off");
    modifyArticle.innerHTML = document.getElementById("template-modifier-article").innerHTML;
    
    document.getElementById("article").append(modifyArticle);

    document.getElementById("titre-creer").innerHTML = dbData.article.titre;
    document.getElementById("contenu-creer").innerHTML = dbData.article.contenu;

    document.getElementById("articleId").setAttribute("value", dbData.article.id);
    
}


const deleteArticle = (dbData) =>{

    let deleteArticle = document.createElement("form");
    deleteArticle.id = "effacer-article-form";
    deleteArticle.setAttribute("action", "guide.php");
    deleteArticle.setAttribute("method", "post");
    deleteArticle.setAttribute("autocomplete", "off");
    deleteArticle.innerHTML = document.getElementById("template-effacer-article").innerHTML;
    
    document.getElementById("article").append(deleteArticle);
    document.getElementById("articleId-effacer").setAttribute("value", dbData.article.id);
}

const loadHistory = (articleList) =>{
    
    let i = 0;
    articleList.forEach(article => {

        let div = document.createElement("div");
        div.id = article.id;
        div.className = "article-liste";
        div.innerHTML = document.getElementById("articleList-form").innerHTML;
        div.innerHTML += document.getElementById("template-creer-liste").innerHTML;
        document.getElementById("historique").append(div);

        document.getElementsByClassName("articleId")[i].setAttribute("value", article.id);

        document.getElementsByClassName("liste-titre")[i].innerHTML = article.titre;
        document.getElementsByClassName("liste-auteur")[i].innerHTML = "Par: " + article.auteur;
        document.getElementsByClassName("liste-date")[i].innerHTML = "Écrit le: " + article.creation_time.substring(0,10);
        i++;
    });
    
}

function catchingBackButtonEvent(global){
    // On override le hash de la page jusqu'à ce qu'on n'y retrouve que des '!'

    global.location.href += "#";
    global.setTimeout(() => {global.location.href += "!";}, 50);
    
	let loaded = 0;
    let _hash = "!";

    // Lorsque qu'un retour en arrière est appelé on intercepte pour empêcher de renvoyer le document précédent
    // On redirige à home.php
    global.onhashchange = () => {
        if (global.location.hash !== _hash && loaded < 5) {
            global.location.hash = _hash;
            loaded ++;
        }
        else {
            document.location.href="home.php";
        }
    };
    //Source: 
    // https://stackoverflow.com/questions/12381563/how-can-i-stop-the-browser-back-button-using-javascript
    // Demo: https://output.jsbin.com/yaqaho#!
}
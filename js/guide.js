
document.addEventListener("load", () => {

});

const displayArticle = (dbData) => {
    // console.log(dbData)

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
    
    document.getElementById("articleId").setAttribute("value", articleId);
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
const modifyArticle = () =>{
    document.getElementById("article").innerHTML = "";

    let articleCreation = document.createElement("form");
    articleCreation.id = "creer-article-wrapper";
    articleCreation.setAttribute("action", "guide.php");
    articleCreation.setAttribute("method", "post");
    articleCreation.setAttribute("autocomplete", "off");
    articleCreation.innerHTML = document.getElementById("template-creer-article").innerHTML;
    
    document.getElementById("article").append(articleCreation);

}

const loadHistory = (articleList) =>{
    // console.log(articleList);
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

// let titre = document.getElementsByClassName("liste-titre")[i];
// titre.innerHTML = article.titre;
// titre.innerHTML += document.getElementById("articleList-form").innerHTML;
// titre.setAttribute("onclick", "postParam(" + article.id + ");");
const postParam = (articleId) =>{
    console.log("POST PARAM CALLED!");

    let formData = new FormData();
    
    formData.append("article", "");
    formData.append("get", "");
    formData.append("articleId", articleId);
    console.log(formData);
    fetch('guide.php', {
        method : "POST",
        credentials: "include",      
        body: formData
    })
    .then( response => response.json());
    // .then( response => {
    //         // Do something with response.
    //         console.log(response);
    // });
}

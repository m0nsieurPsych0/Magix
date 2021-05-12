
document.addEventListener("load", () => {

});

const displayArticle = (dbData) => {
    // console.log(dbData);
    let article = document.createElement("div");
    article.id = "article-wrapper";
    article.innerHTML = document.querySelector("#template-article").innerHTML;
    document.getElementById("article").append(article);

    document.querySelector("h1").innerHTML = dbData.article.titre;
    document.getElementById("auteur-article").innerHTML = dbData.article.auteur;
    document.getElementById("date-article").innerHTML = dbData.article.creation_time;
    document.getElementById("contenu").innerHTML = dbData.article.contenu;

    commentCreation(dbData.article.id);
    displayComment(dbData.comment);
}

const displayComment = (comments) =>{
    comments.forEach(comment => {
        let commentElem = document.createElement("div");
        commentElem.className = "commentaire-wrapper";
        commentElem.innerHTML = document.getElementById("template-commentaire").innerHTML;
        document.getElementById("article").append(commentElem);
        
        document.getElementsByClassName("auteur-commentaire")[comment.id-1].innerHTML = comment.auteur;
        document.getElementsByClassName("date-commentaire")[comment.id-1].innerHTML = comment.creation_time;
        document.getElementsByClassName("contenu-commentaire")[comment.id-1].innerHTML = comment.contenu;
        
    });
}


const commentCreation = (articleId) =>{
    let commentCreation = document.createElement("form");
    commentCreation.id = "ajout-commentaire-wrapper";
    commentCreation.setAttribute("action", "guide.php");
    commentCreation.setAttribute("method", "post");
    commentCreation.setAttribute("autocomplete", "off");
    commentCreation.innerHTML = document.querySelector("#template-ajout-commentaire").innerHTML;

    document.getElementById("article").append(commentCreation);
    
    document.getElementById("articleId").setAttribute("value", articleId);
}

const loadHistory = () =>{


}

const createArticle = () =>{
    //TODO
}
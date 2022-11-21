"use strict";

function modify(e)
{
    let parentNode = e.currentTarget.parentNode;
    let paraph = parentNode.getElementsByTagName("p")[0];
    paraph.innerHTML = "Chaine modifiee";
}

function deleter(e)
{
    e.currentTarget.parentNode.style.display = "none";
}

function addElement (e) {
    // crée un nouvel élément div
    let copyDiv  = document.getElementById('user1');
    let newDiv = copyDiv.cloneNode(true);
  
    // ajoute le nouvel élément créé et son contenu dans le DOM
    document.getElementById('users').appendChild(newDiv);
    newDiv.children[2].addEventListener("click", modify);
    newDiv.children[3].addEventListener("click", deleter);
}



document.addEventListener("DOMContentLoaded", function(){
    let modifiers = document.getElementsByClassName("modify");
    Array.from(modifiers).forEach(m => m.addEventListener("click", modify));

    let remover = document.getElementsByClassName("remove");
    Array.from(remover).forEach(m => m.addEventListener("click", deleter));

    document.getElementById("addNew").addEventListener("click", function(e){
        addElement(e);
    });
});
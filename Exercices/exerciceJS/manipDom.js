"use strict";

function changerCouleur(){
    let descrClass = document.getElementsByClassName("descr");
    
    for(let i in descrClass){
        descrClass[i].style.background = "red";
    }
};
    
document.addEventListener("DOMContentLoaded", changerCouleur);
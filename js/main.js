
var myInput = document.getElementsByTagName('input');

//$(document).ready(function(){
//    
//    $(".container .form").slideDown(, function(){$("form").fadeIn("slow");});
//    
//    
//});

for(var i=0; i<(myInput.length -1); i=i+1) 
{
    myInput[i].onfocus = function(){
    'use strict';
    this.setAttribute('placeholder1', this.getAttribute('placeholder'));
    this.setAttribute('placeholder', '');  
    }; 


    myInput[i].onblur = function(){
    'use strict';
    this.setAttribute('placeholder', this.getAttribute('placeholder1'));
    };  
}


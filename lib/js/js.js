function mascaraCpf(i){
    
    var v = i.value;

    if(isNaN(v[v.length - 1])){ 
       i.value = v.substring(0, v.length - 1);
       return;
    }
    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) {
        i.value += ".";
    }
    if (v.length == 11){ 
        i.value += "-";
 
    }
}

function mascaracartao(i){

    var v = i.value;
    
    if(isNaN(v[v.length - 1])){ 
       i.value = v.substring(0, v.length - 1);
       return;
    }
    i.setAttribute("maxlength", "19");
    if (v.length == 4 || v.length == 9 || v.length == 14) 
        i.value += " ";
 }

function mascaraUsername(i){
    var v = i.value;
    if (v.indexOf(" ") != -1){
        i.value = v.substring(0, v.length - 1);
        return;
    }
 }

 function mascaraTelefone(i){

    var v = i.value;
    if(isNaN(v[v.length - 1])){ 
       i.value = v.substring(0, v.length - 1);
       return;
    }
    i.setAttribute("maxlength", "13");
    if (v.length == 2) 
        i.value += " ";
    else if(v.length ==  8)
        i.value += "-";
 }

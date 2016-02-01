function passwordCheck(pas){
	if(!pas){
		return 0;
	}else if(pas.length<4){
		return -1;
	}
	else{ return 1;
	}
}
function usernameCheck(uname){

	if(!uname){
		return 0;
	}else if (!/^\w+$/.test(uname)) {
		return -1;
}else if(uname.length<4){
		return -1;
	}
	else{ return 1;
	}
}

function onlyStringCheck(value){
//
	if(/^[A-Za-zα-ωΑ-ΩάέήίόύώΆΈΉΊΌΎΏ ]+$/.test(value)){
		return 1;
	}else if(!value){
		return 0;
	}else{ 
	return -1;
	}
}
function onlyStringNumCheck(value){
//
	if(/^[A-Za-zα-ωΑ-ΩάέήίόύώΆΈΉΊΌΎΏ ]+$/.test(value)){
		return 1;
	}else if(!value){
		return 0;
	}else{ 
	return -1;
	}
}
function onlyNumCheck(value){
//
	if(/^[1-9]+$/.test(value)){
		return 1;
	}else if(!value){
		return 0;
	}else{ 
	return -1;
	}
}


function onpressNumCheck(e){
//
	e = e || window.event;
    var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
    var charStr = String.fromCharCode(charCode);
    if (/[1-9]/.test(charStr)) {
        return true;
    }
	else{return false;}
}

function onpressNumCheckZeroIn(e){
//
	e = e || window.event;
    var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
    var charStr = String.fromCharCode(charCode);
    if (/[0-9]/.test(charStr)) {
        return true;
    }
	else{return false;}
}
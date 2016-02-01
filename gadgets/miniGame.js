
var flag = false;
var repeat;
var boxes = [];


function startGame(){
if (flag == false){
	repeat = setInterval(function(){script()},50);
	flag = true;
	boxes["box1"] = false;
	boxes["box2"] = false;
	boxes["box3"] = false;
	document.getElementById("box1").style.backgroundColor = "gray";
	document.getElementById("box2").style.backgroundColor = "gray";
	document.getElementById("box3").style.backgroundColor = "gray";
}

}
function stopGame(){
if(flag == true){
	var box1 = document.getElementById("par1");
	var box2 = document.getElementById("par2");
	var box3 = document.getElementById("par3");
	clearInterval(repeat);
	if(box1.innerHTML==box2.innerHTML && box1.innerHTML==box3.innerHTML){
		document.getElementById("box1").style.backgroundColor = "green";
		document.getElementById("box2").style.backgroundColor = "green";
		document.getElementById("box3").style.backgroundColor = "green";
		alert("winner!");
	}else if(box1.innerHTML==box2.innerHTML){
		document.getElementById("box1").style.backgroundColor = "#8f8e19";
		document.getElementById("box2").style.backgroundColor = "#8f8e19";
	}else if(box1.innerHTML==box3.innerHTML){
		document.getElementById("box1").style.backgroundColor = "#8f8e19";
		document.getElementById("box3").style.backgroundColor = "#8f8e19";
	}else if(box2.innerHTML==box3.innerHTML){
		document.getElementById("box2").style.backgroundColor = "#8f8e19";
		document.getElementById("box3").style.backgroundColor = "#8f8e19";
	}
	flag = false;
}
}
function script(){
var flag1 = false;
var flag2 = false;
var flag3 = false;
if(boxes["box1"] == false){
	var box1 = document.getElementById("par1");
	box1.innerHTML = Math.floor((Math.random()*10)+1);
	flag1 = true;
}
if(boxes["box2"] == false){
	var box2 = document.getElementById("par2");
	box2.innerHTML = Math.floor((Math.random()*10)+1);
	flag2 = true;
}
if(boxes["box3"] == false){
	var box3 = document.getElementById("par3");
	box3.innerHTML = Math.floor((Math.random()*10)+1);
	flag2 = true;
}
if(flag1==false && flag2==false && flag3==false){
	stopGame();
}
}

function mouseEvent(element,state){
	if(flag == true){
		if(state == true && boxes[element.id] == false){
			document.getElementById(element.id).style.backgroundColor = "red";
		}else if (state == false && boxes[element.id] == true){
			document.getElementById(element.id).style.backgroundColor = "red";
		}
		else if(state == false && boxes[element.id] == false){
			document.getElementById(element.id).style.backgroundColor = "gray";
		}else if (state == true && boxes[element.id] == true){
			document.getElementById(element.id).style.backgroundColor = "gray";
		}
	}
}

function clickEvent(element,state){
	if(flag == true){
		if(boxes[element.id] == false){
			document.getElementById(element.id).style.backgroundColor = "red";
			boxes[element.id] = true;
		}
		else if(boxes[element.id] == true){
			document.getElementById(element.id).style.backgroundColor = "gray";
			boxes[element.id] = false;
		}
	}

}



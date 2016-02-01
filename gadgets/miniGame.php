<link rel="stylesheet" type="text/css" href="./gadgets/miniGame.css">
<script type="text/javascript" src="./gadgets/miniGame.js"></script>
<div id="miniGame">
	<div class="gameBoxes" id="box1" onmousedown="clickEvent(this,true)" onmouseout="mouseEvent(this,false)" onmouseover="mouseEvent(this,true)"><p id="par1"></p></div>
	<div class="gameBoxes" id="box2" onmousedown="clickEvent(this,true)" onmouseout="mouseEvent(this,false)" onmouseover="mouseEvent(this,true)"><p id="par2"></p></div>
	<div class="gameBoxes" id="box3" onmousedown="clickEvent(this,true)" onmouseout="mouseEvent(this,false)" onmouseover="mouseEvent(this,true)"><p id="par3"></p></div>
	<div class="gameButtons">
		<input type="button" name="start" value="start" id="start" onclick="setInterval(startGame(),1)" >
		<br>
		<input type="button" name="stop" value="stop" id="stop" onclick="stopGame()" >
	</div>
</div>
<link rel="stylesheet" type="text/css" href="./pages/news.css">

<div id="newsPanel" class="fadeIn">
<?php 
//}
session_start();
	require_once("../libs/sql.php");
	require_once("../libs/db.php");
	$dbConnection = connectToDB();
	if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
		if(isset($_POST['idDelete'])){
			$id = $_POST['idDelete'];
			$pinakas = mysql_query("delete from news where id = '$id' ;");
		}
		if(isset($_POST['idEdit'])){
			$id = $_POST['idEdit'];
			$body = $_POST['editedBody'];
			$header = $_POST['editedHeader'];
			$pinakas = mysql_query("update news set header = '$header' , body = '$body' where id = '$id' ;");
		}
		if(isset($_POST['header'])){
			$header = htmlentities($_POST['header']);
			$body = htmlentities($_POST['body']);
			$date = date('d/m/Y H:i');
			$pinakas = mysql_query("insert into news set header = '$header' , body = '$body' , date = '$date' ;");
			//if($pinakas) echo 'ok';
			//else echo 'error';
		}
	}
$page = 0;
if(isset($_POST['p'])){
	if(is_numeric (json_decode($_POST['p']))){
		$page = mysql_real_escape_string((json_decode($_POST['p'])-1)*5);
	}else {
		$page = 0;
	}
}else{
	$page = 0;
}


/*
$query = "select * from news ORDER BY id DESC;";
$pinakas = odbc_exec($dbConnection, $query); 
$rowNum = odbc_num_rows($pinakas);
$query = "select * from news ORDER BY id DESC limit $page,5 ;";
$pinakas = odbc_exec($dbConnection, $query); 
*/
$pinakas=mysql_query("select * from news ORDER BY id DESC;");
$query = mysql_query("select * from news ORDER BY id DESC limit $page,5 ;");
$rowNum = mysql_num_rows($pinakas);


		while($row = mysql_fetch_array($query)){
			?>
			<div class="newsField"><div id="<?php echo ($row['id']."header"); ?>" class="newsHeader"><?php echo $row['header']; ?></div><div id="<?php echo ($row['id']."body"); ?>" class="newsBody"><?php echo $row['body']; ?></div><div align="right"><?php echo $row['date']; if(isset($_SESSION['username'])){if($_SESSION['userType'] == 1){ echo '<input id="'.($row['id']."edit").'" name="editNewsButton" class="button2" type="button" value="Επεξεργασία" onclick="editNews(this.id)">';echo '<input id="'.($row['id']."delete").'" class="button2" type="button" value="Διαγραφή" onclick="removeNews(this.id)">';}}?></div></div>
			<?php
		}
		echo '<div style="width:100%;text-align:right;margin-top:10px;">';
		$j=1;
		$i=0;
		//for($i=0;$i<$rowNum/5;$i+=5){
		do{
			echo '<a href="#!/pages/news&p='.$j.'">'.$j.'</a><span>&nbsp</span>';
			$j+=1;
			$i+=5;
		}while($i<$rowNum);
		//}
		echo '</div>';
		
?>
<?php 
	if(isset($_SESSION['username'])){
		if($_SESSION['userType'] == 1){
			?>
			<div id="createNews">
			<label for="toPostHeader">Κεφαλίδα</label>
			<input class="textBox" type="text" id="toPostHeader" >
			<br>
			<label for="toPostBody">Μήνυμα</label>
			<textarea class="textBox" id="toPostBody"></textarea>
			<input class="button2" type="button" value="Καταχώρηση" onclick="addNews()">
			</div>
			<?php }} ?>
			</div>
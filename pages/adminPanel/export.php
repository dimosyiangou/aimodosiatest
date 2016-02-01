<?php

session_start();
	if(isset($_SESSION['userType'])){
		if($_SESSION['userType']==1){
	require_once("../../libs/db.php");
	$dbConnection = connectToDB();
	
$username = "root";
$password = "1234";
$hostname = "localhost";
$database = "mydb"; 

$username =escapeshellcmd($username);
//$password =escapeshellcmd($password);
$hostname =escapeshellcmd($hostname);
$database =escapeshellcmd($database);
$backupFile='backups/'.date("d.m.Y--H.i.s_").$database.'.php';
//$command = "\\usr\\bin\\mysqldump --opt -u$username -p$password -h$hostname  $database > $backupFile";
$command = "mysqldump --host=$hostname --user=$username ";
if ($password) 
        $command.= "--password='".$password."' "; 
$command.= $database;
$command.= " > " . $backupFile;
system($command, $result);
echo $result;

$myfile = fopen($backupFile, "r+") or die("Unable to open file!");
$txt = "<?php session_start();if(isset(\$_SESSION['userType'])){if(\$_SESSION['userType']==1){ ?>\n";
fwrite($myfile, $txt);
fclose($myfile);
$myfile = fopen($backupFile, "a+") or die("Unable to open file!");
$txt = "<?php } } ?> \n";
fwrite($myfile, $txt);
fclose($myfile);
}
}
/*
$query = '';
 session_start();
	if(isset($_SESSION['userType'])){
		if($_SESSION['userType']==1){
	require_once("../../libs/db.php");
	$dbConnection = connectToDB();
	$database = "myDB";
      $tables = @mysql_list_tables("myDB");
      while ($row = @mysql_fetch_row($tables)) { $table_list[] = $row[0]; }
 
      for ($i = 0; $i < @count($table_list); $i++) {
 
         $results = mysql_query('DESCRIBE ' . $database . '.' . $table_list[$i]);
 
         $query .= 'DROP TABLE IF EXISTS `' . $database . '.' . $table_list[$i] . '`;' . lnbr;
         $query .= lnbr . 'CREATE TABLE `' . $database . '.' . $table_list[$i] . '` (' . lnbr;
 
         $tmp = '';
 
         while ($row = @mysql_fetch_assoc($results)) {
 
            $query .= '`' . $row['Field'] . '` ' . $row['Type'];
 
            if ($row['Null'] != 'YES') { $query .= ' NOT NULL'; }
            if ($row['Default'] != '') { $query .= ' DEFAULT \'' . $row['Default'] . '\''; }
            if ($row['Extra']) { $query .= ' ' . strtoupper($row['Extra']); }
            if ($row['Key'] == 'PRI') { $tmp = 'primary key(' . $row['Field'] . ')'; }
 
            $query .= ','. lnbr;
 
         }
 
         $query .= $tmp . lnbr . ');' . str_repeat(lnbr, 2);
 
         $results = mysql_query('SELECT * FROM ' . $database . '.' . $table_list[$i]);
 
         while ($row = @mysql_fetch_assoc($results)) {
 
            $query .= 'INSERT INTO `' . $database . '.' . $table_list[$i] .'` (';
 
            $data = Array();
 
            while (list($key, $value) = @each($row)) { $data['keys'][] = $key; $data['values'][] = addslashes($value); }
 
            $query .= join($data['keys'], ', ') . ')' . lnbr . 'VALUES (\'' . join($data['values'], '\', \'') . '\');' . lnbr;
 
         }
 
         $query .= str_repeat(lnbr, 2);
 
      }
	 }
	}
	*/
?>


<?php
session_start();
require_once("../../libs/sql.php");
require_once("../../libs/db.php");
$dbConnection = connectToDB();
$pinakas = mysql_query("select * from donationdonor as dd inner join dates d on dd.donationID=d.id inner join users u on dd.donorID = u.id where d.id = '$datesList'");
if(mysql_num_rows($pinakas)>=1){
	/*print '<script type="text/javascript">'; 
print 'alert("The email address '. $_POST['email'].' is already registered")'; 
print '</script>'; 
*/
 echo '<script type="text/javascript">alert("It works.");</script>';
}
?>

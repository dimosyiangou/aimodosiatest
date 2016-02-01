<link rel="stylesheet" type="text/css" href="/pages/contact/contact.css">
<?php
require_once("../../gadgets/captcha.php");
session_start(); 

function spamcheck($field) {
  // Sanitize e-mail address
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);
  // Validate e-mail address
  if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
    return TRUE;
  } else {
    return FALSE;
  }
}
?>
<div id="contactMain" class="fadeIn">

<?php
// display form if user has not clicked submit
if (!isset($_POST["from"])) {
  ?>
  <h2>Αποστολή email</h2>
  <form method="post" >
  <label class="newsletterLabel">Από:</label> <input id="from" class="textBox" type="text" name="from"><br>
  <label class="newsletterLabel">Θέμα:</label>  <input id="subject" class="textBox" type="text" name="subject" id="mailSubject"><br>
  <label class="newsletterLabel">Μήνυμα:</label>  <textarea id="message" class="textBox" name="message"></textarea><br>
  <label class="newsletterLabel">captcha:</label><img style="margin-left:20px;" src="<?php echo getCaptchaString('../../assets/captchaImages/'); ?>">
  <br><input id="captcha" style="margin-left:80px;" class="textBox" type="text" name="captcha">
  
  <input style="float:right;" class="button2" onclick="mailContact()" value="Αποστολή" type="button">
  <!--input style="float:right;" class="button2" type="submit" name="submit" value="Αποστολή"-->
  </form>
  
  
  <?php 
} else {  

	if(isset($_SESSION['captcha']) && $_SESSION['captcha'] == $_POST['captcha'] && spamcheck($_POST['from']) && strlen($_POST['subject'])!=0 && strlen($_POST['message'])!=0){
		
			$from =  $_POST["from"]; // sender
			$subject = $_POST["subject"];
			$message = $_POST["message"];
			mail('stefbreaker@gmail.com',$subject,$message,"From: $from\n");
			echo 'Επιτυχής Αποστολή';
		
	}else{
	$captcha = $_POST['captcha'];
	if($_SESSION['captcha'] != $captcha && strlen($captcha)!=0){ $wrongCaptcha = true;} else {$wrongCaptcha = false;}
	if(!spamcheck($_POST['from'])){ $wrongFrom = true;} else {$wrongFrom = false;}
	?>
	
	<h2>Αποστολή email</h2>
  <form method="post">
  <label class="newsletterLabel">Από:</label> <input id="from" class="textBox" type="text" name="from" value="<?php echo $_POST['from'];?>"><label style="color:red;width:200px;" class="newsletterLabel"><?php if($wrongFrom) echo 'Η διεύθυνση δεν είναι έγκυρη';?></label><br>
  <label class="newsletterLabel">Θέμα:</label>  <input id="subject" class="textBox" type="text" name="subject" id="mailSubject" value="<?php echo $_POST['subject'];?>"><br>
  <label class="newsletterLabel">Μήνυμα:</label>  <textarea id="message" class="textBox" name="message"><?php echo $_POST['message'];?></textarea><br>
  <label class="newsletterLabel">captcha:</label><img style="margin-left:20px;" src="<?php echo getCaptchaString('../../assets/captchaImages/'); ?>">
  <br><input id="captcha" style="margin-left:80px;" class="textBox" type="text" name="captcha"><label style="color:red;width:200px" class="newsletterLabel"><?php if($wrongCaptcha) echo 'Λάθος captcha';?></label>
    <input style="float:right;" class="button2" onclick="mailContact()" value="Αποστολή" type="button">
	</form>
	
	<?php }
}
?></div>
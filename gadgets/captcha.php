<?php 
    
	function getCaptchaString($path){
		$length = rand(4, 6);
		$captchaString ="";
		for($i = 0 ; $i<$length; $i++){
			$choice = rand(0, 1);
			if( $choice == 0 ){
				$captchaString = $captchaString.getCaptchaLetter();
			}else{
				$captchaString = $captchaString.getCaptchaNumber();
			}
		}
		
		$_SESSION['captcha'] = $captchaString;
		//readyImage($captchaString, $path);
		return readyImage($captchaString, $path);
	}
	
	function getCaptchaNumber(){
		$number = rand(0, 9);
		return $number;
	}
	
	function getCaptchaLetter(){
		$number = rand(0, 25);
		$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$char = $letters[$number];
		return $char;
	}
	
	function setCaptchaImage($str){
		$htmlString = "";
		for($i = 0; $i<strlen($str);$i++){
			$htmlString = $htmlString . '<img src="/assets/captchaImages/'.$str[$i].'.png">';
		}
		return $htmlString;
	}
	
	function readyImage($str, $path){
	
		
    $im = imagecreatetruecolor(25*strlen($str), 40);
    imagesavealpha($im, true);

    $trans_colour = imagecolorallocatealpha($im, 0, 0, 0, 127);
    imagefill($im, 0, 0, $trans_colour);
    
    $red = imagecolorallocate($im, 255, 0, 0);
    imagefilledellipse($im, 400, 300, 400, 300, $red);
	
	$line_color = imagecolorallocate($im, 64,64,64); 
	for($i=0;$i<10;$i++) {
		imageline($im,0,rand()%50,200,rand()%50,$line_color);
	}
	
	$pixel_color = imagecolorallocate($im, 0,0,255);
	for($i=0;$i<1000;$i++) {
		imagesetpixel($im,rand()%200,rand()%50,$pixel_color);
	}  

	$font = './arial.ttf';
	
	$text_color = imagecolorallocate($im, 0, 0, 0);
	imagettftext($im, 23, 0, 10, 30, $text_color, $font, $str);

		
	header("Content-type: image/png");
	$path = $path.md5($str).'.png';
    imagepng($im,$path);
	
return $path;
}
	?>
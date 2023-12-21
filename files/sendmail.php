<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('email@kochur.com.ua', 'Mother travel');
	//Кому отправить
	$mail->addAddress('glomokomo@gmail.com');
	//Тема письма
	$mail->Subject = 'Application for a call from the site "Mother travel"';

	//Тело письма
	$body = '<h1>Customer data</h1>';
	
	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
	}
	if(trim(!empty($_POST['tel']))){
		$body.='<p><strong>Tel:</strong> '.$_POST['tel'].'</p>';
	}
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}
	
	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Error';
	} else {
		$message = 'Data sent successfully. We will contact you shortly';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>
<?php
$to = "vas@email.cz";
$extra = "From: ".$_POST['email']."\r\nReply-To: ".$_POST['email']."\r\n";
$subject = "Vzkaz od ".$_POST['jmeno']."";
$mess = "Jm�no: ".$_POST['jmeno']."\nEmail: ".$_POST['email']."\nWeb: ".$_POST['web']."\nText:\n".$_POST['text']."";
mail ($to, $subject, $mess, $extra);
?>
<html><head>
<meta http-equiv="refresh" content="0; url=index.php">
<title>P�esm�rov�n�...</title>
</head><body></body></html>
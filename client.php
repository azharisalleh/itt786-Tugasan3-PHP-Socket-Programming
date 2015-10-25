<html>
<head>
</head>
/*
Tugasan 3 : Socket Programming Using PHP
Author Azhari Hj Salleh
Github ID : github/azharisalleh
Title : Server - Client Program
*/ 
<body>
 
<?php
// form not yet submitted
if (!$submit)
{
?>
<form action="<? echo $PHP_SELF; ?>" method="post">
Enter some text:<br>
<input type="Text" name="message" size="15"><input type="submit" name="submit" value="Send">
</form>
<?php
}
else
{
// form submitted
 
// where is the socket server?
$host="127.0.0.1";
$port = 8888;
 
// open a client connection
$fp = fsockopen ($host, $port, $errno, $errstr);
 
if (!$fp)
{
$result = "Error: could not open socket connection";
}
else
{
// get the welcome message
fgets ($fp, 1024);
// write the user string to the socket
fputs ($fp, $message);
// get the result
$result .= fgets ($fp, 1024);
// close the connection
fputs ($fp, "exit");
fclose ($fp);
 
// trim the result and remove the starting ?
$result = trim($result);
$result = substr($result, 2);
 
// now print it to the browser
}
?>
Server said: <b><? echo $result; ?></b>
<?
}
?>
 
</body>
</html>
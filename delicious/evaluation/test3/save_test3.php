<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title>del.icio.us annotation - test 3</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
</style>
</head>
<body>
<pre>
<?
$name = $_POST['user'];
if ($name == "")
    $name = "anonymous";
$time = time();

$fd = fopen('result/'.$name.$time, 'w');

foreach($_POST as $tag => $value){
	if ($tag != "user"){
	    fputs($fd, $tag.' '.$value."\n");
    }
}
fclose($fd);
?>
<h1>del.icio.us annotation - test 3</h1>
thank you, the session has been successfully saved.<br/>
</body>
</html>

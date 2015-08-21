<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title>TWITA Sentiment Annotation</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
</style>

</head>
<body>
<h1>TWITA Sentiment Annotation</h1>
<form action="annotation.php" method="GET">
Nome: <input type="text" name="name" />
<br/>
set:
<select name="set">
<option value="normal">generico</option>
<option value="hashtag">hashtag #Grillo</option>
</select>
<br/>
<input type="submit" value="inizia"/>
</form>
</body>
</html>

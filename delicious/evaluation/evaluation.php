<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title>Crawling del.icio.us</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
	margin-left:20%;
	margin-right:20%;
}

td {
	border: 1px solid #ddd;
}

.td_number {
	text-align: right;
}
.footnote {
	font-size: smaller;
	font-style: italic;
}

pre {
	background: #ddd;
}
</style>
</head>
<?
$user = isset($_GET["user"]) ? $_GET["user"] : "VB";
?>
<frameset rows="50%, 50%">
<frame src="list.php?user=<?=$user?>" name="list"/ >
<frame src="" name="link"/ >

</frameset>
</html>

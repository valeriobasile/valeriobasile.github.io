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

<?php
$name = $_GET['name'];
if ($name == "")
    $name = "anonymous";
$time = time();
$set = $_GET['set'];

# get indices
$indices = array();
$lines_file = $set=="hashtag" ? "random_lines_hashtag" : "random_lines";
$fd = fopen($lines_file, "r");

while (!feof($fd)){
    $line = fgets($fd);
    if ($line != ''){
        $indices[] = substr($line,0,-1);
        $n++;
    }
}


$result_file = $set=="hashtag" ? 'results/hashtag_'.$name : 'results/'.$name;
$backup_file = $set=="hashtag" ? 'results/hashtag_'.$name.$time : 'results/'.$name.$time;
$fd = fopen($result_file, 'w');
$fd_bak = fopen($backup_file, 'w');
$n = 0;
$npos = 0;
$nneu = 0;
$nneg = 0;
$nnull = 0;

foreach ($indices as $i){
    $pos = $_POST['pos_'.$i];
    $neu = $_POST['neu_'.$i];
    $neg = $_POST['neg_'.$i];
    if ($pos) {
        $polarity = 1;
        $npos++;
    }
    elseif ($neu) {
        $polarity = 0;
        $nneu++;
    }
    elseif ($neg) {
        $polarity = -1;
        $nneg++;
    }
    else {
        $polarity = -2;
        $nnull++;
    }
    if ($polarity != -2){
        fputs($fd, $i.' '.$polarity."\n");
        fputs($fd_bak, $i.' '.$polarity."\n");
        $n++;
    }
}
#echo $n.' '.$npos.' '.$nneu.' '.$nneg.' '.$nnull;
fclose($fd);
fclose($fd_bak);
?>
<h1>TWITA Sentiment Annotation</h1>
Grazie! (salvate <?=$n?> annotazioni)<br/>
La sessione &egrave; stata salvata con successo.
<a href="index.php">indietro</a>
</body>
</html>

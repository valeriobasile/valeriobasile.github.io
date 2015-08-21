<?
function progress_bar($progress, $total){
	if ($progress < $total){
		print "<div style=\"float:left; width:".$progress."px; background-color: lightblue\">&nbsp;</div>";
		print "<div style=\"float:left; width:".($total-$progress)."px; background-color: lightgrey\">&nbsp;</div>";
	}
	else {
		print "<div style=\"float:left; width:".$total."px; background-color: lightgreen\">&nbsp;</div>";	
	}
}

$name = isset($_GET["name"]) ? $_GET["name"] : "anonymous";
$set = isset($_GET["set"]) ? $_GET["set"] : "normal";

# resume
$resume = array();
$resume_file = $set=='hashtag' ? 'results/hashtag_'.$name : 'results/'.$name;

if (is_file($resume_file)){
    $fd = fopen($resume_file,"r");
    while (!feof($fd)) {
        $line = fgets($fd);
        $fields = explode(" ",substr($line,0,-1));
        $index = $fields[0];
        $polarity = $fields[1];
        $resume[$index] = $polarity;
        
    }
    fclose($fd);
    $first_time = false;
}
else {
    $first_time = true;
}
#print_r($resume); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title>TWITA Sentiment Annotation</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
	margin-left:25%;
	margin-right:25%;
	background: url(sd-bg.png) repeat;
}
table {
    border-collapse: collapse;
}

.pos, .neu, .neg{
    width: 48px;
    height: 48px;
    vertical-alignment: top;
}

.tweet {
    width: 20em;
    background: #fff;
}

.tweettd{
    padding:1em;
}

.save {
    background:url(save.png);
    width:48px;
    height:48px;<input type="hidden" name="name" value="<?=$name?>" />

    background-repeat: no-repeat;
    font-weight: bold;
    
}

input[type=checkbox]:before {
    content:"";
    display:inline-block;
    width:48px; 
    height:48px;
}

input[type=checkbox].pos:before {
    background:url(pos_off.png);
}
input[type=checkbox].pos:checked:before { 
    background:url(pos_on.png);
}
input[type=checkbox].neg:before {
    background:url(neg_off.png);
}
input[type=checkbox].neg:checked:before { 
    background:url(neg_on.png);
}
input[type=checkbox].neu:before {
    background:url(neu_off.png);
}
input[type=checkbox].neu:checked:before { 
    background:url(neu_on.png);
}
</style>
</head>
<body>
<h1>TWITA Sentiment Annotation</h1>
<? if ($set == "hashtag"){ ?>
<em>tweet con hashtag #Grillo</em>
<?}?>
<strong>Stato attuale:</strong><br/>
<?
progress_bar(count($resume)/2, 500);
?>
<br/><hr/><br/>

<form action="save.php?name=<?=$name?>&set=<?=$set?>" method="POST">
<!--<input type="hidden" name="name" value="<?=$name?>" />
<input type="hidden" name="set" value="<?=$set?>" />-->
<table alt="annotation">
<tr><td style="text-align:center" colspan="4"><strong>Tweet non ancora annotati</strong> (<?=1000-count($resume)+1?>)</td></tr>
<tr>
<td style="text-align:center; padding:1em;">salva<br/><input type="submit" class="save" value="" /></td>
<td><img src="pos_on.png" /></td>
<td><img src="neu_on.png" /></td>
<td><img src="neg_on.png" /></td>
</tr>
<?
$sample_file = $set=='hashtag' ? 'random_tweets_hashtag' : 'random_tweets';
$file = fopen($sample_file,"r");
$n = 0;
while (!feof($file))
{
    $line = fgets($file);
    $fields = explode("\t",$line);
    $index = $fields[0];
    $text = $fields[5];
    if ($index != "" and !in_array($index, array_keys($resume))){
        echo('<tr class="tweet"><td class="tweettd">');
        echo(''.$text.'</td>');
        
        $checked = $resume[$index] == '1' ? 'checked="checked"' : '';
        echo('<td><input type="checkbox" class="pos" id="pos_'.$index.'" '.$checked.' name="pos_'.$index.'" onclick=\'document.getElementById("neg_'.$index.'").checked = false;document.getElementById("neu_'.$index.'").checked = false\' /></td>');
        $checked = $resume[$index] == '0' ? 'checked="checked"' : '';
        echo('<td><input type="checkbox" class="neu" id="neu_'.$index.'" '.$checked.' name="neu_'.$index.'" onclick=\'document.getElementById("pos_'.$index.'").checked = false;document.getElementById("neg_'.$index.'").checked = false\' /></td>');
        $checked = $resume[$index] == '-1' ? 'checked="checked"' : '';
        echo('<td><input type="checkbox" class="neg" id="neg_'.$index.'" '.$checked.' name="neg_'.$index.'" onclick=\'document.getElementById("pos_'.$index.'").checked = false;document.getElementById("neu_'.$index.'").checked = false\' /></td>');
        echo("</tr><tr><td colspan='4'>&nbsp;</td></tr>\n");
        if ($n % 20 == 19){
            echo('<tr><td style="text-align:center; padding:1em;">salva<br/><input type="submit" class="save" value="" /></td>');
            echo('<td><img src="pos_on.png" /></td>');
            echo('<td><img src="neu_on.png" /></td>');
            echo('<td><img src="neg_on.png" /></td></tr>');
        }
        
        $n++;
    }
} 
?>
<tr><td style="text-align:center" colspan="4"><strong>Tweet precedentemente annotati</strong> (<?=count($resume)-1?>)</td></tr>
<?
$file = fopen($sample_file,"r");
$n=0;
while (!feof($file))
{
    $line = fgets($file);
    $fields = explode("\t",$line);
    $index = $fields[0];
    $text = $fields[5];
    if ($index != "" and in_array($index, array_keys($resume))){
        echo('<tr class="tweet"><td class="tweettd">');
        echo(''.$text.'</td>');
        
        $checked = $resume[$index] == '1' ? 'checked="checked"' : '';
        echo('<td><input type="checkbox" class="pos" id="pos_'.$index.'" '.$checked.' name="pos_'.$index.'" onclick=\'document.getElementById("neg_'.$index.'").checked = false;document.getElementById("neu_'.$index.'").checked = false\' /></td>');
        $checked = $resume[$index] == '0' ? 'checked="checked"' : '';
        echo('<td><input type="checkbox" class="neu" id="neu_'.$index.'" '.$checked.' name="neu_'.$index.'" onclick=\'document.getElementById("pos_'.$index.'").checked = false;document.getElementById("neg_'.$index.'").checked = false\' /></td>');
        $checked = $resume[$index] == '-1' ? 'checked="checked"' : '';
        echo('<td><input type="checkbox" class="neg" id="neg_'.$index.'" '.$checked.' name="neg_'.$index.'" onclick=\'document.getElementById("pos_'.$index.'").checked = false;document.getElementById("neu_'.$index.'").checked = false\' /></td>');
        echo("</tr><tr><td colspan='4'>&nbsp;</td></tr>\n");
        if ($n % 20 == 19){
            echo('<td style="text-align:center; padding:1em;" colspan="4">salva<br/><input type="submit" class="save" value="" /></td></tr>');
        }
        
        $n++;
    }
} 
?>
</table>
<div style="text-align:center; padding:1em;">
salva<br/>
<input type="submit" class="save" value="" />
</div>
</form>
</body>
</html>

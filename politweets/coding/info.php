<?
function progress_bar($progress, $total){
	if ($progress < $total){
		print "<div class=\"progress\" style=\"float:left; height: 30px; width:".$progress."px; background-color: #f99;\">&nbsp;</div>";
		print "<div style=\"float:left; width:".($total-$progress)."px; height: 30px; background-color: lightgrey\">&nbsp;</div>";
	}
	else {
		print "<div style=\"float:left; width:".$total."px; height: 30px; background-color: lightgreen\">&nbsp;</div>";	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Twitter politics</title>
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

.progress {
    background-image:url('mlp.png');
    background-repeat:no-repeat;
    /*background-attachment:fixed;*/
    background-position:right; 
}
</style>

</head>
<body>
<h2>Progress</h2>
<table border='1'>
<thead>
<th>Party</th>
<th>progress</th>
<th>coded</th>
<th>total</th>
</thead>
<tbody>
<?
# open SQLite database from tab-separated data
try{
    $db = new PDO('sqlite:db/politweets.sqlite3');
}
catch(PDOException $e) {
    echo $e->getMessage();
}

# statistics
$sql_party = "SELECT DISTINCT party FROM tweet";
$result_party = $db->query($sql_party);
$rows_party = $result_party->fetchAll();

$csv_fields = array();
$csv_fields[] = date("U");
$coded_all = 0;
$total_all = 0;
foreach($rows_party as $row_party) {
    $party = $row_party['party'];
    
    $sql = "SELECT count(*) as c FROM tweet WHERE party = '".$row_party['party']."'";
    $result = $db->query($sql);
    $rows = $result->fetch();
    $total_tweets = $rows["c"];

    $sql = "SELECT count(distinct tweet_ind) as c FROM code WHERE party = '".$row_party['party']."'";
    $result = $db->query($sql);
    $rows = $result->fetch();
    $coded_tweets = $rows["c"];

    $progress = ceil(($coded_tweets * 100) / $total_tweets);
    echo "<tr><td>".$party."</td><td>";
    progress_bar($progress *3, 300);
    echo "</td><td>".$coded_tweets."</td><td>".$total_tweets."</td></tr>";
        
    $csv_fields[] = $coded_tweets;
    
    $coded_all += $coded_tweets;
    $total_all += $total_tweets;    
}

// write log
$fp = fopen('log/progress.csv', 'a');
fputcsv($fp, $csv_fields);
fclose($fp);
chmod('log/progress.csv', 0766);
?>
</tbody>
</table>
<p>
total progress:
<strong>
<?echo round(($coded_all * 100 ) / $total_all, 2)."%";?>
</strong>
(<?=$coded_all?>/<?=$total_all?>)
</p>
</body>
</html>

<pre>
<?
function get_label($itemlist, $value){
    foreach ($itemlist as $item) {
        if ($item['value']==$value) {
            return $item['label'];
        }
    }
}

ini_set('max_execution_time', 300);
# open SQLite database from tab-separated data
try{
    $db = new PDO('sqlite:db/politweets.sqlite3');
}
catch(PDOException $e) {
    echo $e->getMessage();
}

require_once('items.php');

$i = 2;
foreach ($items as $label => $itemlist) {
    $var = "T".$i;
    $i ++;
    echo "\"$label\",\"count\"\n";
    $sql = "SELECT ".$var.", count(".$var.") as c from code group by ".$var.";";
    $result = $db->query($sql);
    $rows = $result->fetchAll();
    foreach($rows as $row) {
      if ($row[1] != 0) {
        echo ("\"".get_label($itemlist, $row[0])."\",\"".$row[1]."\"\n");
      }
    }
    echo "\n";
}
?>
</pre>

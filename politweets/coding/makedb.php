<pre>
<?php
$DB_FILE = "db/politweets.sqlite3";

# create SQLite database from tab-separated data
unlink($DB_FILE);
$db = new PDO('sqlite:'.$DB_FILE);
$db->exec("CREATE TABLE IF NOT EXISTS tweet (
                timestamp INTEGER, 
                user TEXT, 
                message TEXT)");

# read tab-separated data file
$data = array();
$fd = fopen("../politweets_twoweeks.tab", "r");
if ($fd) {
    while (($line = stream_get_line($fd, 1024, "\n")) !== false) {
        $fields = explode("\t", $line);
        $data[] = array('timestamp' => $fields[0], 
                        'user' => $fields[1], 
                        'message' => $fields[2]);
    }
}
if (!feof($fd)) {
    echo "Error: unexpected fgets() fail\n";
}
fclose($fd);

# execute statements
$db->beginTransaction();
foreach($data as $item){
    $db->exec("INSERT INTO tweet (timestamp, user, message) 
                VALUES (".$fields[0].", '".$fields[1]."', '".$fields[2]."');");
}
$db->commit();

echo "done\n";
?>
</pre>

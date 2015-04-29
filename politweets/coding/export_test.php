<?
ini_set('max_execution_time', 300);
# open SQLite database from tab-separated data
try{
    $db = new PDO('sqlite:db/politweets.sqlite3');
}
catch(PDOException $e) {
    echo $e->getMessage();
}

for ($i=2; $i<=10; $i++) {
    #echo $i;
    $fp = fopen('testset+text/T'.$i.'.csv', 'w');
    #fputcsv($fp, array('bert','joris','petra','sjoerd'));

    $sql = "SELECT c_Douwe.T".$i.", c_Guido.T".$i.", message
    FROM tweet_test
    INNER JOIN code as c_Douwe
    ON c_Douwe.tweet_ind = tweet_test.ind
    INNER JOIN code as c_Guido
    ON c_Guido.tweet_ind = tweet_test.ind
    where c_Douwe.partition='test'
    and c_Guido.partition='test'
    and c_Douwe.coder='Douwe'
    and c_Guido.coder='Guido'
    order by tweet_test.party";
    $result = $db->query($sql);
    $rows = $result->fetchAll();

    foreach($rows as $row) {
        $fields = array();
        $fields [] = $row[0];
        $fields [] = $row[1];
        $fields [] = $row[2];
        if ($row[0]!=''&&$row[1]!='')
            fputcsv($fp, $fields);
    }
    fclose($fp);
    chmod('testset/T'.$i.'.csv', 0766);
}

# 'personal' variable test
$fp = fopen('testset+text/personal.csv', 'w');

$sql = "SELECT c_Douwe.T8, c_Guido.T8, message
FROM tweet_test
INNER JOIN code as c_Douwe
ON c_Douwe.tweet_ind = tweet_test.ind
INNER JOIN code as c_Guido
ON c_Guido.tweet_ind = tweet_test.ind
where c_Douwe.partition='test'
and c_Guido.partition='test'
and c_Douwe.coder='Douwe'
and c_Guido.coder='Guido'
order by tweet_test.id";

$result = $db->query($sql);
$rows = $result->fetchAll();

foreach($rows as $row) {
    $fields = array();
    $fields [] = $row[0];
    $fields [] = $row[1];
    $fields [] = $row[3];
    fputcsv($fp, $fields);
}

#header("location: testset/");
?>

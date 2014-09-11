<?php
ini_set('max_execution_time', 500); // increasing the execution time for php incase of larger csv files
$connect = mysql_connect('localhost','root','');
if (!$connect) {
die('Could not connect to MySQL: ' . mysql_error());
}

$cid =mysql_select_db('test',$connect);

$csv_file = "candidate-info_1.csv"; 
$csvfile = fopen($csv_file, 'r');
$theData = fgets($csvfile);
$i = 0;

while (!feof($csvfile)) {
$csv_data[] = fgets($csvfile, 1024);
$csv_array = explode(",", $csv_data[$i]);

$data=explode(';',$csv_array[0]);

$insert_csv = array();
$insert_csv['email'] = $data[0];
$insert_csv['name'] = $csv_array[1];
$insert_csv['mobile'] = $csv_array[2];

$query = "INSERT INTO csvtosql(id,email,name,mobile)
VALUES('','".$insert_csv['email']."','".$insert_csv['name']."','".$insert_csv['mobile']."')";
$n=mysql_query($query, $connect );
$i++;
}
fclose($csvfile);
echo "File data successfully imported to database!!";

mysql_close($connect);
?>
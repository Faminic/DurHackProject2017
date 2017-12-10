<?php
$servername = "myeusql.dur.ac.uk";
$username = "lptx42";
$password = "i5pswich";


$id=$_POST["id"];
$dbh = new PDO('mysql:host='.$servername.';dbname=Xlptx42_durhack', $username, $password);
$sql = "SELECT * FROM items WHERE id=".$id;
		$item=0;
        foreach ($dbh->query($sql) as $row) {
			$item=1;
			echo $row['latitude']." ".$row['longitude'];
		}
?>
<?php
$id=$_POST["id"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$servername = "myeusql.dur.ac.uk";
$username = "lptx42";
$password = "i5pswich";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM items WHERE id=".$id;//"INSERT INTO items (id, latitude, longitude) VALUES (".$id.",".$latitude." ,".$longitude." )";
try {
        $dbh = new PDO('mysql:host='.$servername.';dbname=Xlptx42_durhack', $username, $password);
		$item=0;
        foreach ($dbh->query($sql) as $row) {
			$item=1;
			/*print $row['id'] . "\t";
			print $row['latitude'] . "\t";
			print $row['longitude'] . "\n";*/
		}
		if($item==0){
			$sql="INSERT INTO items (id, latitude, longitude) VALUES (".$id.",".$latitude." ,".$longitude." )";
			$dbh->prepare($sql)->execute();
		}else{
			$sql="UPDATE items SET latitude=".$latitude." ,longitude=".$longitude." WHERE id=".$id;
			$dbh->prepare($sql)->execute();
		}
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
}


$conn->close();
?>
<html>
<body>

</body>
</html>


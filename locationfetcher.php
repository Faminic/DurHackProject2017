<?php
$id=$_GET["id"];
$latitude = $_GET["latitude"];
$longitude = $_GET["longitude"];
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully, sharing location on ".$id;
$sql = "SELECT * FROM items WHERE id=".$id;//"INSERT INTO items (id, latitude, longitude) VALUES (".$id.",".$latitude." ,".$longitude." )";
try {
        $dbh = new PDO('mysql:host=localhost;dbname=test', $username, $password);
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
echo"
<script>
async function main(){
	await sleep(5000);
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	}
}


function showPosition(position) {
	post('locationfetcher.php',{id:".(string)$id.",latitude:position.coords.latitude,longitude:position.coords.longitude});
}
function post(path, params, method) {
    method = method || \"put\"

    var form = document.createElement(\"form\");
    form.setAttribute(\"method\", method);
    form.setAttribute(\"action\", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement(\"input\");
            hiddenField.setAttribute(\"type\", \"hidden\");
            hiddenField.setAttribute(\"name\", key);
			document.write(key);
            hiddenField.setAttribute(\"value\", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}
function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
main();
</script>";
?>
<html>
<body>

</body>
</html>


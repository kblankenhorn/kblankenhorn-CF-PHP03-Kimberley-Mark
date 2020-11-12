<?php 

ob_start();
session_start();
require_once 'connect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
 header("Location: login.php");
 exit;
}
if(isset($_SESSION["user"])){
	header("Location: home.php");
	exit;
}

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * FROM test WHERE id = $id";
		$result = mysqli_query($conn, $sql);
		$row = $result->fetch_assoc();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<form action="update_a.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
		<p>Name: <input type="text" name="name" value="<?php echo $row['name'] ?>"></p>
		<p>Address: <input type="text" name="address" value="<?php echo $row['address'] ?>"></p>
		<p>Number of rooms: <input type="text" name="roomnum" value="<?php echo $row['roomnum'] ?>"></p>
		
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> 
    	<p>Image: <img width="250px" src="<?php echo $row['picture'] ?>" alt=""></p>
    	<p>Choose a file to upload: <input name="uploaded_file" type="file" />
 
		<input type="submit" name="submit" value="update">
	</form>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>

<?php ob_end_flush(); ?>

<?php 

require_once 'db_connect.php';

if (isset($_POST)) {
    if ((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
        $filename = basename($_FILES['uploaded_file']['name']);
		$ext = substr($filename, strrpos($filename, '.') + 1);
		
        if (($ext == "jpg") && ($_FILES["uploaded_file"]["type"] == "image/jpeg") &&
			($_FILES["uploaded_file"]["size"] < 800000)) 
			{
            	$newname = dirname(_FILE_).'/img/'.$filename;
            // "uploads" is a folder inside of the main folder
            if (!file_exists($newname)) {
                if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname))) {
                    $name = $_POST['name'];
                    $ingredients = $_POST['ingredients'];
                    $price = $_POST['price'];
                    $allergens = $_POST['allergens'];

                    $sql = "UPDATE meals SET image = '$newname', name = '$name', ingredients = '$ingredients', price = '$price', allergens = '$allergens' WHERE mealID = {$id}";

                    if (mysqli_query($conn, $sql)) {
                        echo '<h2>Updated successfully</h2>';
                        header("Refresh:2; url=index.php");
                    } else {
                        echo "Error: A problem occurred during file upload to the database!";
                    }
                } else {
					echo "Error: A problem occured during the file upload (move_uploaded_file method)";
                }
            } else {
                echo "Error: File " . $_FILES["uploaded_file"]["name"] . " already exists";
            }
        } else {
            echo "Error: Only .jpg images under 800Kb are accepted for upload";
        }
    } else {
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $price = $_POST['price'];
    $allergens = $_POST['allergens'];

   $id = $_POST['id'];

   $sql = "UPDATE meals SET name = '$name', ingredients = '$ingredients', price = '$price', allergens = '$allergens' WHERE mealID = {$id}" ;
   if($connect->query($sql) === TRUE) {
       echo  "<p>Successfully Updated</p>";
       echo "<a href='../update.php?id=" .$id."'><button type='button'>Back</button></a>";
       echo  "<a href='../index.php'><button type='button'>Home</button></a>";
   } else {
        echo "Error while updating record : ". $connect->error;
   }

   $connect->close();

}

?>
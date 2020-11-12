<?php 

require_once 'db_connect.php';

if (isset($_POST)) {
    if ((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
        $filename = basename($_FILES['uploaded_file']['name']);
        $ext = substr($filename, strrpos($filename, '.') + 1);

        if (($ext == "jpg") && ($_FILES["uploaded_file"]["type"] == "image/jpeg") && ($_FILES["uploaded_file"]["size"] < 800000)) {
            $newname = dirname(_FILE_) . './img/' . $filename;
            $newname2 = dirname(_FILE_) . '/img/' . $filename;

            if (!file_exists($newname)) {
                if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname))) {
                    $name = $_POST['name'];
                    $ingredients = $_POST['ingredients'];
                    $price = $_POST['price'];
                    $allergens = $_POST['allergens'];

                    $sql = "INSERT INTO meals (image, name, ingredients, price, allergens) VALUES ('$newname2', '$name', '$ingredients', '$price', '$allergens')";

                    if ($connect->query($sql) === true) {
                        echo "<h2>Created successfully</h2>";
                        header("Refresh:2; url=../index.php");
                    } else {
                        echo "Error: A problem occurred during file upload to the database!";
                    }
                } else {
					echo "Error: A problem occured during the file upload (move_uploaded_file method)";
                }
            } else{
				echo "Error: File " . $_FILES["uploaded_file"]["name"] . " already exists";
			}
		}else {
				echo "Error: Only .jpg images under 800Kb are accepted for upload";
			}
    } else {
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $price = $_POST['price'];
    $allergens = $_POST['allergens'];

    $sql = "INSERT INTO meals (name, ingredients, price, allergens) VALUES ('$name', '$ingredients', '$price', '$allergens')";
    if($connect->query($sql) === TRUE) {
        echo "<p>New Record Successfully Created</p>" ;
        echo "<a href='../create.php'><button type='button' class='btn btn-info'>Back</button></a>";
        echo "<a href='../index.php'><button type='button' class='btn btn-info'>Home</button></a>";
    } else  {
        echo "Error " . $sql . ' ' . $connect->connect_error;
    }

    $connect->close();
}
}
?>
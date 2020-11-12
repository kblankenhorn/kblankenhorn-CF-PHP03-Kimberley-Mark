<?php
include "connect.php";

if (isset($_POST['submit'])) {

    if ((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
        $filename = basename($_FILES['uploaded_file']['name']);
        $ext = substr($filename, strrpos($filename, '.') + 1);

        if (($ext == "jpg") && ($_FILES["uploaded_file"]["type"] == "image/jpeg") && ($_FILES["uploaded_file"]["size"] < 800000)) {
            $newname = dirname(_FILE_) . '/uploads/' . $filename;

            if (!file_exists($newname)) {
                if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname))) {
                    $name = $_POST["name"];
                    $address = $_POST["address"];
                    $roomnum = $_POST["roomnum"];

                    $sql = "INSERT INTO test(`name`,`address`,`roomnum`,`picture`) VALUES ('$name','$address',$roomnum, '$newname')";

                    if ($conn->query($sql) === true) {
                        echo "<h2>Created successfully</h2>";
                        header("Refresh:2; url=index.php");
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
        $name = $_POST["name"];
        $address = $_POST["address"];
        $roomnum = $_POST["roomnum"];

        $sql = "INSERT INTO test(`name`,`address`,`roomnum`) VALUES ('$name','$address',$roomnum)";
        //var_dump($sql);
        if ($conn->query($sql) === true) {
            echo "<h2>Created successfully</h2>";
            header("Refresh:3; url=index.php");
        } else {
            echo "Error by insert of data without image";
        }
    }
}
?>
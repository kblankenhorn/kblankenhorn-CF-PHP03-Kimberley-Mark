
<?php 

require_once 'db_connect.php';

if ($_POST) {
    $image = $_POST['image'];
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $price = $_POST['price'];
    $allergens = $_POST['allergens'];

   $id = $_POST['id'];

   $sql = "UPDATE meals SET image = '$image', name = '$name', ingredients = '$ingredients', price = '$price', allergens = '$allergens' WHERE mealID = {$id}" ;
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
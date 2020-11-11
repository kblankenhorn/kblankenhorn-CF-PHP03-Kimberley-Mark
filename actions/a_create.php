<?php 

require_once 'db_connect.php';

if ($_POST) {
    $image = $_POST['image'];
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $price = $_POST['price'];
    $allergens = $_POST['allergens'];

    $sql = "INSERT INTO meals (image, name, ingredients, price, allergens) VALUES ('$image', '$name', '$ingredients', '$price', '$allergens')";
    if($connect->query($sql) === TRUE) {
        echo "<p>New Record Successfully Created</p>" ;
        echo "<a href='../create.php'><button type='button' class='btn btn-info'>Back</button></a>";
        echo "<a href='../index.php'><button type='button' class='btn btn-info'>Home</button></a>";
    } else  {
        echo "Error " . $sql . ' ' . $connect->connect_error;
    }

    $connect->close();
}

?>
<?php 

ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user' ]) && !isset($_SESSION["admin"]) ) {
    header("Location: login.php");
    exit;
   } elseif(isset($_SESSION["user"])){
     header("Location: index.php");
   }

// Why are we using get?
if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM meals WHERE mealID = {$id}";
   $result = $connect->query($sql);

   $data = $result->fetch_assoc();

   $connect->close();

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

   <title>Edit Meal</title>

</head>
<body>

<fieldset>
   <legend>Update Meal</legend>

   <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
       <table  class="table table-bordered">
           <tr>
               <th>Image</th >
               <td><img  src="<?php echo $row['image'] ?>" width="250px"><input type="hidden" name="MAX_FILE_SIZE" value="1000000" /><input type="file" name="uploaded_file" placeholder="choose a file to upload...jpg"></td >
           </tr >    
           <tr>
               <th>Name</th>
               <td><input type= "text" name="name"  value ="<?php echo $data['name'] ?>" /></td >
           </tr>
           <tr>
               <th>Ingredients</th>
               <td><input type= "text" name="ingredients"  value ="<?php echo $data['ingredients'] ?>" /></td>
           </tr>
           <tr>
               <th>Price</th>
               <td><input type= "text" name="price"  value ="<?php echo $data['price'] ?>" /></td>
           </tr>
           <tr>
               <th>Allergens</th>
               <td><input type= "text" name="allergens"  value ="<?php echo $data['allergens'] ?>" /></td>
           </tr>
           <tr>
               <input type= "hidden" name= "id" value= "<?php echo $data['mealID']?>" />
               <td><a href= "index.php"><button  type="button" class='btn btn-info'>Back</button ></a ></td >
               <td><button type="submit" class='btn btn-info'>Save Changes</button ></td>
           </tr>
       </table>
   </form >

</fieldset >

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body >
</html >

<?php
}
ob_end_flush();
?>
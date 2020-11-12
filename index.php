<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user' ]) ) {
 header("Location: login.php");
 exit;
}
// select logged-in users details
$res=mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   
    <title>Welcome - <?php echo $userRow['userEmail' ]; ?></title>

</head>
<body>

<div class ="container">
  
Hi <?php echo $userRow['userEmail' ]; ?>
           
           <a  href="logout.php?logout">Sign Out</a>
   
   <table class="table table-bordered mt-5">
       <thead>
           <tr>
               <th scope="col">image</th>
               <th scope="col">name</th>
               <th scope="col">ingredients</th>
               <th scope="col">price</th>
               <th scope="col">allergens</th>
           </tr>

       </thead>

       <tbody>

           
       <?php
           $sql = "SELECT * FROM meals";
           $result = $connect->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                   echo  "<tr>
                       <td><img src='". $row['image'] ."' alt='image' class='img-thumbnail' style='width:100px; height:100px; object-fit:cover;'></td>
                       <td>" .$row['name']."</td>
                       <td>" .$row['ingredients']."</td>
                       <td>" .$row['price']."</td>
                       <td>" .$row['allergens']."</td>
                       <td>
                           <a href='update.php?id=" .$row['mealID']."'><button type='button' class='btn btn-info'>Edit</button></a>
                           <a href='delete.php?id=" .$row['mealID']."'><button type='button' class='btn btn-info'>Delete</button></a>
                       </td>
                   </tr>" ;
               }
           } else  {
               echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
           }
            ?>

       </tbody>
   </table>
    <a href= "create.php"><button type="button" class="btn btn-info">Add Meal</button></a>
</div>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
<?php ob_end_flush(); ?>
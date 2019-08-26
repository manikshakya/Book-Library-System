<?php 

include 'connect.php';


//echo '<pre>' , print_r(mysqli_fetch_array($result)) , '</pre>';



?>

<!doctype html>
<html>

  <head>
    <title>Search Books</title>
    <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="book_form.css">
  </head>

  <body>
    <!-- a href="index.html">Home</a -->
    <a href="index.html">Home</a>

    <h1>Book Library System</h1>
    <h3>Add Book into the Library</h3>

    <form method="post">
      <p><input type="text" name="firstname" placeholder="Firstname"></p>
      <p><input type="text" name="surname" placeholder="Surname"></p>
      <p><input type="text" name="street" placeholder="Street"></p>
      <p><input type="text" name="city" placeholder="City"></p>
      <p><input type="text" name="email" placeholder="Email"></p>
      
      <p> <button class="search_employee" name = "submit" type="submit">Add Person</button> </p>
    </form>

    <?php
      if(isset($_POST['submit'])){
        $firstname = mysqli_real_escape_string($db_connection, $_POST['firstname']);
        $surname = mysqli_real_escape_string($db_connection, $_POST['surname']);
        $street = mysqli_real_escape_string($db_connection, $_POST['street']);
        $city = mysqli_real_escape_string($db_connection, $_POST['city']);
        $email = mysqli_real_escape_string($db_connection, $_POST['email']);

        if($firstname != "" && $surname != "" && $street != "" && $city != "" && $email != ""){
          $query = "INSERT INTO `members` (`firstName`, `surname`, `street`, `city`, `email`) 
                    VALUES (\"$firstname\", \"$surname\", \"$street\", \"$city\", \"email\");";

          $result = mysqli_query($db_connection, $query);

          echo '<pre>', print_r($result) ,'</pre>';

          if($result){
            echo "Book added Successfully";
          } else {
            echo "Cannot add Book to the Database.<br/>";
            echo mysqli_error($db_connection);
          }
        } else {
          echo "Please enter all the fields.";
        }
      }
    ?>

    <table>
      <tr>
        <th>MemberId</th>
        <th>Firstname</th>
        <th>Surname</th>
        <th>Street</th>
        <th>City</th>
        <th>Email</th>
      </tr>
      
    

    <?php
      $query = "SELECT * FROM members";
        $result = mysqli_query($db_connection, $query);

        if($result){
          if(mysqli_num_rows($result) > 0){
            while($result_row = mysqli_fetch_array($result)){
              // echo $result_row['ISBN'] . '<br/>';
              // // echo $result_row['title'] . '<br/>';
              // // echo $result_row['Available'] . '<br/>';
              // echo '<br/><br/>';

              ?>
              <tr>
                <td><?php echo $result_row['memberNo']; ?></td>
                <td><?php echo $result_row['firstName']; ?></td>
                <td><?php echo $result_row['surname']; ?></td>
                <td><?php echo $result_row['street']; ?></td>
                <td><?php echo $result_row['city']; ?></td>
                <td><?php echo $result_row['email']; ?></td>
              </tr>
              
              <?php
            }
          } else {
            echo "No Person Found.<br/>";
          }
        } else {
          echo "No Person Found and better.<br/>";
        }
      
    ?>

    </table>

    

    


  </body>

</html>
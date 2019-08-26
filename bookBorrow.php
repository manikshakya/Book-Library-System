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
    <h3>Insert the Book ISBN and the Person ID.</h3>

    <form method="post">
      <p><input type="text" name="bookid" placeholder="Books ID"></p>
      <p><input type="text" name="personid" placeholder="Person ID"></p>
      
      <p> <button class="search_employee" name = "submit" type="submit">Borrow</button> </p>
    </form>

    <?php
      if(isset($_POST['submit'])){

        $bookid = $_POST['bookid'];
        $personid = $_POST['personid'];
    
        if($bookid != "" && $personid != ""){
          // $query = "SELECT * FROM `books`";
          //$query = "SELECT * FROM books where LOCATE("The", title)";
          $query = "INSERT INTO `bookTracker` (bookNo, member)
                    VALUES (\"$bookid\", \"$personid\")";

          $result = mysqli_query($db_connection, $query);

          if($result){
            echo "Book Borrow Successfully.";
          } else {
            echo "No Book Found and better.<br/>";
            echo mysqli_error($db_connection);
          }
        } else {
          echo "Please enter all the fields.";
        }
      }
    ?>

    </table>


  </body>

</html>
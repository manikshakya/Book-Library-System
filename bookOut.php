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
    <h3>List of People with the Book.</h3>

    <form method="post">
      <p><input type="text" name="search" placeholder="Search Books"></p>
      
      <p> <button class="search_employee" name = "submit" type="submit">Search</button> </p>
    </form>

    <?php
      if(isset($_POST['submit'])){

        $search = $_POST['search'];

        $condition = $_POST['searchOption'];
      }

      if(isset($_POST['deleteCode'])){
        $split = explode("+", $_POST['deleteCode']);
        echo 'BookId: ' . $split[0] . "<br/>" . 'MemberId: ' . $split[1];
        $query = "DELETE FROM `bookTracker` WHERE bookNo = $split[0] && member = $split[1];";
          
        if($result = mysqli_query($db_connection, $query)){
          if(mysqli_affected_rows($db_connection) == 1){
            echo "<br/><h2>Record deleted successfully. </h2>";
          } else {
            echo "Delete not successful." . mysqli_error($db_connection);
          }
        }
        
      }
    ?>

    <form method="post">
    <table>
      <tr>
        <th>BookId</th>
        <th>ISBN</th>
        <th>Title</th>
        <th>Person</th>
        <th>Delete</th>
      </tr>
      
    

    <?php
        // $query = "SELECT * FROM `books`";
        //$query = "SELECT * FROM books where LOCATE("The", title)";
        $query = "SELECT books.BookNo, books.ISBN, books.title, members.memberNo, 
                    members.firstName, members.surname 
                    FROM bookTracker 
                    JOIN books ON books.BookNo = bookTracker.bookNo 
                    JOIN members ON members.memberNo = bookTracker.member";

        // Put the where clause in the query. (where title = $search) ---------------
        if($search != ""){
          $query .= " WHERE LOCATE(\"$search\", title) OR ISBN = \"$search\"";
          // echo $query;
        }

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
                <td><?php echo $result_row['BookNo']; ?></td>
                <td><?php echo $result_row['ISBN']; ?></td>
                <td><?php echo $result_row['title']; ?></td>
                <td><?php echo $result_row['firstName'] . " " . $result_row['surname']; ?></td>
                <td><?php echo "<button type='submit' class='search_employee' name='deleteCode' value=" . $result_row['BookNo']. "+" . $result_row['memberNo'] . ">X</button>"; ?></td>
              </tr>
              
              <?php
            }
          } else {
            echo "No Book Found.<br/>";
          }
        } else {
          echo "No Book Found and better.<br/>";
        }
      
      
    ?>

    </table>
    </form>


  </body>

</html>
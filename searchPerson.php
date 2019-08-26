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
    <h3>Search book by Firstname or Lastname.</h3>

    <form method="post">
      <p><input type="text" name="firstname" placeholder="Firstname"></p>
      <p><input type="text" name="lastname" placeholder="Lastname"></p>
      <!-- <p>Books: 
        <select name="searchOption">
          <option>Available</option>
          <option>Unavailable</option>
        </select>
      </p> -->
      
      <p> <button class="search_employee" name = "submit" type="submit">Search</button> </p>
    </form>

    <?php
      if(isset($_POST['submit'])){

        $search = $_POST['search'];
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
        $query = "SELECT * FROM `members`";
        //$query = "SELECT * FROM books where LOCATE("The", title)";
        // $query = "SELECT books.ISBN, members.firstName, members.surname FROM bookTracker 
        //             JOIN books ON books.BookNo = bookTracker.bookNo 
        //             JOIN members ON members.memberNo = bookTracker.member";

        if($search != ""){
          $query .= " WHERE LOCATE(\"$search\", firstName) OR LOCATE(\"$search\", surname)";
          // echo $query;
        } else {
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
            echo "No Book Found.<br/>";
          }
        } else {
          echo "No Book Found and better.<br/>";
        }
      }
    ?>

    </table>

    <!-- <?php
      $query = "SELECT * FROM `books`";
      //$query = "SELECT * FROM books where LOCATE("The", title)";
      // $query = "SELECT books.ISBN, members.firstName, members.surname FROM bookTracker 
      //             JOIN books ON books.BookNo = bookTracker.bookNo 
      //             JOIN members ON members.memberNo = bookTracker.member";

      if($search != ""){
        $query .= " WHERE LOCATE(\"$search\", title) OR ISBN = \"$search\"";
        echo $query;
      } else {
        echo $query;
      }

      $result = mysqli_query($db_connection, $query);

      echo '<pre>', print_r($result) ,'</pre>';

      if($result){
        if(mysqli_num_rows($result) > 0){
          while($result_row = mysqli_fetch_array($result)){
            echo $result_row['ISBN'] . '<br/>';
            // echo $result_row['title'] . '<br/>';
            // echo $result_row['Available'] . '<br/>';
            echo '<br/><br/>';
          }
        } else {
          echo "No Book Found.<br/>";
        }
      } else {
        echo "No Book Found and better.<br/>";
      }
    ?> -->


  </body>

</html>
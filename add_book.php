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
      <p><input type="text" name="bookName" placeholder="Book Title"></p>
      <p><input type="text" name="ISBN" placeholder="ISBN Number"></p>
      <p><input type="text" name="author" placeholder="Author"></p>
      <p><input type="text" name="review" placeholder="Review's URL"></p>
      
      <p> <button class="search_employee" name = "submit" type="submit">Add Book</button> </p>
    </form>

    <?php
      if(isset($_POST['submit'])){
        $bookName = mysqli_real_escape_string($db_connection, $_POST['bookName']);
        $ISBN = mysqli_real_escape_string($db_connection, $_POST['ISBN']);
        $author = mysqli_real_escape_string($db_connection, $_POST['author']);
        $review = mysqli_real_escape_string($db_connection, $_POST['review']);

        if($bookName != "" && $ISBN != "" && $author != "" && $review != ""){
          $query = "INSERT INTO `books` (`ISBN`, `title`, `author`, `copies`, `review`) 
                    VALUES (\"$ISBN\", \"$bookName\", \"$author\", 1, \"$review\");";

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
        <th>BookId</th>
        <th>ISBN</th>
        <th>Title</th>
        <th>Author</th>
        <th>Available</th>
      </tr>
      
    

    <?php
      $query = "SELECT * FROM books";
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
                <td><?php echo $result_row['author']; ?></td>
                <td><?php echo $result_row['Available']; ?></td>
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

    

    


  </body>

</html>
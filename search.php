<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style type="text/css">
    .jumbotron {
        padding: 4rem 2rem;
        margin-bottom: 2rem;
        background-color: var(--bs-light);
        border-radius: .3rem;
    }
    #maincontainer {
        min-height: 100vh;
    }
   
     </style>

    <title>EDiscuss - Coding forums</title>
</head>

<body>
<?php
    include 'partials/_dbconnect.php';  //_before.php file name means that user will not be exposed to this file
?>
<?php include 'partials/_header.php'; ?>


  <!-- Search results starts here -->
 <div class="container my-3 mb-5">
    <h1 class="py-2">Search results for : <small><em>"<?php echo $_GET['search']; ?>"</em></small></h1>
    <?php
    $noResults = true;
    $query = $_GET['search'];
    $sql ="SELECT * FROM threads WHERE MATCH (thread_title,thread_desc) against ('$query')";
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_id = $row['thread_id'];
        $url = "thread.php?threadid=".$thread_id;
        $noResults = false;

        //Display the search results
        echo    '<div class="result">
                    <h3><a href="' .$url. '" class="text-dark">'. $title .'</a></h3>
                    <p>'. $desc .'</p>
                </div>';
                echo "<hr>";
    }
    if($noResults){
        echo '  <div class="jumbotron jumbotron-fluid">
                    <div class="container" >
                        <p class="display-6">No results found.</p>
                        <p class="lead">It looks like there arent many great matches for your search</p>
                        <p class="lead">Suggestions:</p>
                        <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li>
                        </ul>
                        
                </div>';
    }

?>
 </div> 

    <?php
  include 'partials/_footer.php';
  ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>
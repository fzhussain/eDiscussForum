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
    #ques {
        min-height: 433px;
    }
     </style>

    <title>EDiscuss - Coding forums</title>
</head>

<body>
<?php
    include 'partials/_dbconnect.php';  //_before.php file name means that user will not be exposed to this file
?>
<?php include 'partials/_header.php'; ?>

    <!-- Slider starts here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?programming,html" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?programming,microsoft" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?coding,programming" class="d-block w-100"
                    alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
    <!-- Category container starts here -->
    <div class="conatiner my-4 mx-4" id="ques">
        <h2 class="text-center my-4">EDiscuss - Browse Categories</h2>
        <div class="row my-4">

            <!-- Fetch all the categories Use a loop to iterate through categories -->
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
              // echo $row['category_id'];
              // echo $row['category_name'];
              // echo "<br>";
              $id = $row['category_id'];
              $cat = $row['category_name'];
              $desc = $row['category_description'];

              /* To use teh saved images from img folder use the below commented statement */
              /* <img src="img/card-'.$id.'.jpg" class="card-img-top" alt="image of category '.$id.'"> */
              /* Note : Your image in img folder must be named as card-1.jpg, card-2.jpg, card-3.jpg and so on... */

              echo '<div class="col-md-4 my-2 ">
                        <div class="card" style="width: 18rem;">
                            <img src="https://source.unsplash.com/500x400/?program,'.$cat.'" class="card-img-top" alt="...">
                            <div class="card-body my-2">
                                <h5 class="card-title"><a href="threadlist.php?catid='.$id.' " class="text-dark">'.$cat.'</a></h5>
                                <p class="card-text">'.substr($desc,0,90).'...</p>
                                <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                            </div>
                        </div> 
                    </div>';
            }
          ?>

        </div>
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
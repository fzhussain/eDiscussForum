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
    <?php
    include 'partials/_header.php';
    ?>

    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $th_user_id = $row['thread_user_id'];

        //Query to find out who posted the question
        $sql2 = "SELECT user_email FROM `users` WHERE sno = '$th_user_id'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $askedby = $row2['user_email'];
    }
   

    ?>
    <?php
    $id = $_GET['threadid'];
    $showAlert = false;
    $mehtod = $_SERVER['REQUEST_METHOD'];
    if ($mehtod == 'POST') {
        //insert thread into commentDB
        $comment = $_POST['comment'];
        $comment = str_replace("<","&lt;",$comment);
        $comment = str_replace(">","&gt;",$comment);
        $sno = $_POST['sno'];
        
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your comment has been added.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>';
        }
    }
    ?>

    <!-- Category container starts here -->
    <div class="conatiner my-4 mx-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo "$title"; ?> </h1>
            <p class="lead"><?php echo "$desc"; ?></p>
            <hr class="my-4">

            <p>Posted by:<b> <?php echo $askedby; ?></b></p>
        </div>

    </div>

    <!-- Here we want to submit to proj3_forum/threadlist.php?catid=1 that is why we used REQUEST_URI If we didn't had the terms after ? (catid=1) we could simply use PHP_SELF-->
    <?php 
    if((isset($_SESSION['loggedin'])) && $_SESSION['loggedin'] == true){
        echo '<div class="container my-5">
        <h2 class="py-2">Post a Comment</h2>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
          <div class="mb-3">
                <label for="comment" class="form-label">Type your Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>';
    }else{
        echo '
            <div class="container">
            <h1 class="py-2">Post a Comment</h1>
            <p class="lead">You are not logged in. Please login to be able to post comments.</p>
            </div>
            ';

    }
    
    ?>
    <div class="container mb-5" id="ques">
        <h1 class="py-2">Discussions</h1>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
             $id = $row['comment_id'];
             $content = $row['comment_content'];
             $comment_time = $row['comment_time'];
             $thread_user_id = $row['comment_by'];
             $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
             $result2 = mysqli_query($conn,$sql2);
             $row2 = mysqli_fetch_assoc($result2);
             
            echo '<div class="d-flex border p-5 my-3">
            <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe" class="flex-shrink-0 mr-3 mt-2 " style="width:60px;height:60px;">
            <div class="mx-4">
              <p>'.$content.'</p>
              <p class="fw-bold my-0">Replied by: '. $row2['user_email'].' at <span>'.$comment_time.'</span></p>
            </div>
        </div>';
        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <p class="display-6">No Comments found.</p>
                            <p class="lead">Be the first person to post a comment.</p>
                        </div>
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
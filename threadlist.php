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

    <title>iDiscuss - Coding forums</title>
</head>

<body>
    <?php
    include 'partials/_dbconnect.php';  //_before.php file name means that user will not be exposed to this file
    ?>
    <?php
    include 'partials/_header.php';
    ?>


    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }

    ?>
    <?php
    $showAlert = false;
    $mehtod = $_SERVER['REQUEST_METHOD'];
    if ($mehtod == 'POST') {
        //insert thread into DB
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<","&lt;",$th_title);
        $th_title = str_replace(">","&gt;",$th_title);

        $th_desc = str_replace("<","&lt;",$th_desc);
        $th_desc = str_replace(">","&gt;",$th_desc);

        

        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your thread has been added! Please wait for the community to respond.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>';
        }
    }
    ?>

    <!-- Category container starts here -->
    <div class="conatiner my-4 mx-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo "$catname"; ?> forums</h1>
            <p class="lead"><?php echo "$catdesc"; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other.</p>
            <h4>Disclaimer</h4>

            <ul>
                <li>Spam / Advertising / Self-promote
                    in the forums are not allowed.</li>
                <li>Do not post copyright-infringing material.</li>
                <li>Do not post “offensive” posts, links or images.</li>
                <li>Do not cross post questions.</li>
                <li>Remain respectful of other members at all times.</li>
            </ul>

            <!-- <a class="btn btn-success btn-lg" href="#" role="button">Browse Topics</a> -->
        </div>

    </div>
    <!-- Here we want to submit to proj3_forum/threadlist.php?catid=1 that is why we used REQUEST_URI If we didn't had the terms after ? (catid=1) we could simply use PHP_SELF-->
    <?php 
    if((isset($_SESSION['loggedin'])) && $_SESSION['loggedin'] == true){
        echo
        '<div class="container my-5">
            <h1 class="py-2">Start a Discussion</h1>
            <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
        
                <div class="mb-3">
                    <label for="title" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible</div>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Elaborate Your Concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';

    } else{
            echo '
            <div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <p class="lead">You are not logged in. Please login to be able to start a Discussion.</p>
            </div>
            ';
        }
    ?>


    <div class="container my-5 mb-5 " id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $user_email = $row2['user_email'];
            
            echo '<div class="d-flex border p-5 my-3">
            <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe" class="flex-shrink-0 mr-3 mt-2 " style="width:60px;height:60px;">
            <div class="mx-4">
            <h4><a href="thread.php?threadid=' . $id . '" class="text-dark" >' . $title . '</a></h4>
                <p>' . $desc . '</p>
                <p class="fw-bold my-0"> Asked by: '. $user_email .' at <span>'.$thread_time.'</span></p>
            </div>
        </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <p class="display-6">No Threads found.</p>
                            <p class="lead">Be the first person to ask a question</p>
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
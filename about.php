<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <style type="text/css">
    .jumbotron {
      padding: 4rem 2rem;
      margin-bottom: 2rem;
      background-color: var(--bs-light);
      border-radius: .3rem;
    }
  </style>

  <title>iDiscuss - Coding forums</title>
</head>

<body>
  <?php include 'partials/_dbconnect.php'; ?>
  <?php include 'partials/_header.php'; ?>
  <div class="conatiner my-4 mx-4">
    <div class="jumbotron">
      <h4>This is a coding forum where you can ask your doubts regarding the programming languages and can discuss
        with your peers.</h4>
      <p class="lead">Further modifications are expected soon..</p>
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
      
    </div>
  </div>
  <div class="conatiner my-4 mx-4">
    <div class="jumbotron">
      
      
    </div>
  </div>

  <?php include 'partials/_footer.php'; ?>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>
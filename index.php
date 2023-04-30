<?php
// Include the config file

// $_POST -> super global var
if (!empty($_POST["submit__button"])) {
    echo $_POST["username"];
    echo $_POST["comment"];
}

// DB connection
try {
  $dbh = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
} catch (PDOException $e) {
  echo "Something went wrong: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>PHP forum</title>
</head>
<body>
  <h1 class="title">PHP forum</h1>
  <div class="forum__wrapper__container">
    <section>
      <article>
        <div class="test__article_wrapper">
          <span>Name: </span>
          <p classname="test__username">Hiro</p>
          <time>04/29/23(Sat)05:17:58</time>
        </div>
        <p class="test__comment"></p>
      </article>
    </section>
    <form class="forum__wrapper" method="POST">
      <div>
        <input type="submit" value="Input post" name="submit__button">
        <label for="">Name: </label>
        <input type="text" name="username">
      </div>
      <div>
        <textarea class="comment__text__area" name="comment" id="" cols="30" rows="10"></textarea>
      </div>
    </form>
  </div>
</body>
</html>

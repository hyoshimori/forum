<?php
$comment_arr = array();
$dbh = null;
$stmt = null;

// DB connection
try {
  $dbh = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
} catch (PDOException $e) {
  echo "Something went wrong: " . $e->getMessage();
}

// $_POST -> super global var
if (!empty($_POST["submit__button"])) {
  // echo $_POST["username"];
  // echo $_POST["comment"];

  $postDate = date("Y-m-d H:i:s");

  try{

    $stmt = $dbh->prepare("INSERT INTO `forum-table` (`username`, `comment`, `postDate`) VALUES (:username, :comment, :postDate)");
    $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
    $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
    $stmt->bindParam(':postDate', $postDate, PDO::PARAM_STR);

    $stmt->execute();

  }catch(PDOException $e){

    echo "Something went wrong: " . $e->getMessage();

  }

}

// fetch data
$sql = "SELECT `id`, `username`, `comment`, `postDate` FROM `forum-table`";
$comment_arr = $dbh->query($sql);

// close connection
$dbh = null; // Corrected the typo from '$pdo' to '$dbh'
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
      <!-- <article>
        <div class="test__article_wrapper">
          <span>Name: </span>
          <p classname="test__username">Hiro</p>
          <time>04/29/23(Sat)05:17:58</time>
        </div>
        <p class="test__comment"></p>
      </article> -->
      <?php foreach($comment_arr as $comment):?>
        <article>
          <div class="test__article_wrapper">
            <span>Name: </span>
            <p classname="test__username"><?php echo $comment["username"]?></p>
            <time><?php echo $comment["postDate"]?></time>
          </div>
          <p class="test__comment"></p>
        </article>
      <?php endforeach?>
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

<?php
  $pdo = new PDO('sqlite:chinook.db');
  $sql = "
    SELECT genres.GenreId, genres.Name
    FROM genres
  ";
  $statement = $pdo->prepare($sql);
  $statement->execute();
  $genres = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Assignment 1</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
  <table class="table">
    <tr>
      <th>ID</th>
      <th>Genres</th>
    </tr>
    <?php foreach($genres as $genre) : ?>
      <tr>
        <td>
          <?php echo $genre->GenreId ?>
        </td>
        <td>
          <?php
            echo '<a href="tracks.php?genre=', urlencode($genre->Name ), '">';
              echo $genre->Name?>
          </a>
        </td>
      </tr>
    <?php endforeach ?>
  </table>
</body>
</html>
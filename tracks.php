<?php
  $pdo = new PDO('sqlite:chinook.db');
  $sql = "
    SELECT
      tracks.Name as trackName,
      albums.title as title,
      artists.Name as artistName,
      tracks.UnitPrice
    FROM tracks
    INNER JOIN albums
    ON tracks.AlbumId = albums.AlbumId
    INNER JOIN genres
    ON tracks.GenreId = genres.GenreId
    INNER JOIN artists
    ON albums.ArtistId = artists.ArtistId
  ";
  if (isset($_GET['genre'])) {
    $sql = $sql . ' WHERE genres.Name = ?';
  }
  $statement = $pdo->prepare($sql);
  if (isset($_GET['genre'])) {
    $statement->bindParam(1, $_GET['genre']);
  }
  $statement->execute();
  $tracks = $statement->fetchAll(PDO::FETCH_OBJ);

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
      <th>Album Name</th>
      <th>Title</th>
      <th>Artist Name</th>
      <th>Price</th>
    </tr>
    <?php foreach($tracks as $track) : ?>
      <tr>
        <td>
          <?php echo $track->trackName ?>
        </td>
        <td>
          <?php echo $track->title ?>
        </td>
        <td>
          <?php echo $track->artistName?>
        </td>
        <td>
          <?php echo '$' . $track->UnitPrice ?>
        </td>
      </tr>
    <?php endforeach ?>
    <?php if(count($tracks) === 0) : ?>
      <tr>
        <td colspan="4">No tracks found</td>
      </tr>
    <?php endif ?>
  </table>
</body>
</html>
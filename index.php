<?php
require_once 'utility/connect.php';
require_once 'utility/functions.php';

$query = $db->query("SELECT * FROM posts");
$posts = $query->fetchAll(PDO::FETCH_OBJ);

if (empty($posts)) {
    exit("Content not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SEO Url PHP, tolgahanacar.net">
    <title>SEO Url - PHP</title>
</head>
<body>
    <?php foreach ($posts as $post): ?>
        <div>
            <label for="<?= htmlspecialchars($post->postname) ?>"><?= htmlspecialchars($post->postname) ?></label>
            <p><?= htmlspecialchars($post->postdesc) ?></p>
            <a href="post/<?= seolink($post->postname) . '-' . $post->id ?>">More</a>
        </div><br><br>
    <?php endforeach; ?>

    <div>
        <h2>Created</h2>
        <a href="https://github.com/tolgahanacar">Github</a><br>
        <a href="https://tolgahanacar.net">tolgahanacar.net</a>
    </div>
</body>
</html>

<?php
require_once 'utility/connect.php';

$id = $_REQUEST['id'] ?? null;
if (!$id) {
    header("Location: ../index.php");
    exit;
}

$query = $db->prepare("SELECT * FROM posts WHERE id = :id");
$query->bindParam(":id", $id, PDO::PARAM_INT);
$query->execute();
$post = $query->fetch(PDO::FETCH_OBJ);

if (!$post) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="date" content="<?= htmlspecialchars($post->postdate) ?>">
    <meta name="description" content="<?= htmlspecialchars($post->postdesc) ?> | SEO Url - PHP">
    <title><?= htmlspecialchars($post->postname) ?></title>
</head>
<body>
    <div>
        <h2><?= htmlspecialchars($post->postname) ?></h2>
        <p><?= htmlspecialchars($post->postdesc) ?></p>
    </div>
</body>
</html>
?>

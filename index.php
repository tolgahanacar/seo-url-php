<?php
require_once 'utility/connect.php';
require_once 'utility/functions.php';
?>
<?php
$check = $db->prepare("SELECT * FROM posts");
$check->execute();
$check2 = $check->fetchAll(PDO::FETCH_OBJ);
$count  = $check->rowCount();
if ($count > 0) {
    foreach ($check2 as $posts) {
        $postid   = $posts->id;
        $postname = $posts->postname;
        $postdesc = $posts->postdesc;
    }
} else {
    echo "Content not found!";
    die();
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
    <?php foreach ($check2 as $posts) { ?>
        <div>
            <label for="<?php echo $posts->postname; ?>"><?php echo $posts->postname; ?></label>
            <p><?php echo $posts->postdesc ?></p>
            <a href="post/<?php echo seolink($posts->postname) . "-" . $posts->id; ?>">More</a>
        </div><br><br>
    <?php } ?>

    <div>
        <h2>Created</h2>
        <a href="https://github.com/tolgahanacar">Github</a><br>
        <a href="https://tolgahanacar.net">tolgahanacar.net</a>
    </div>
</body>


</html>
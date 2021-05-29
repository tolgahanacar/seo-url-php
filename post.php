<?php
require_once 'utility/connect.php';
$req = $_REQUEST['id'];
if (isset($req)) {
} else {
    header("location:../index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $check = $db->prepare("SELECT * FROM posts WHERE id = :id");
    $check->bindParam(":id", $req, PDO::PARAM_INT);
    $check->execute();
    $check2 = $check->fetchAll(PDO::FETCH_OBJ);
    $count  = $check->rowCount();
    if ($count > 0) {
        foreach ($check2 as $posts) {
            $postid   = $posts->id;
            $postname = $posts->postname;
            $postdesc = $posts->postdesc;
            $postdate = $posts->postdate;
        }
    } else {
        echo "Content not found!";
        header("location:../index.php");
        die();
    }

    ?>
<meta name='date' content='<?php echo $postdate; ?>'>
    <meta name="description" content="<?php echo $postdesc; ?> | SEO Url - PHP">
    <title><?php echo $postname; ?></title>
</head>

<body>
    <div>
        <h2><?php echo $postname; ?></h2>
        <p><?php echo $postdesc; ?></p>
    </div>
</body>

</html>
<?php

include_once('App/config.php');
include_once('App/Database/database.php');

$db = new Database($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
$data = array();

if(isset($_GET['search'])){
    $search = htmlspecialchars($_GET['search']);
    $data = $db->search($search);
}else{
    $data = $db->list();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>DB Home</title>
</head>

<body>
    <nav class="container">
        <div class="flex-container" style="width: 100%; justify-content: space-between;">
            <a class="btn-a" href="<?php echo $BASE_URL ?>">
                <h1>DB Home</h1>
            </a>
        </div>
    </nav>
    <div class="flex-container" style="justify-content: center;">
        <div>
            <h1 style="text-align: center;">All Data</h1>
            <form>
                <input type="hidden" value="SEARCH_REQUEST">
                <input type="text" name="search">
                <button type="submit">Search</button>
            </form>
            <table border="1">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Availablity</th>
                    <th>ISBN</th>
                    <th>Option</th>
                </tr>
                <?php foreach ($data as $key => $obj) : ?>

                    <tr class="obj-row">
                        <td class="obj-item">
                            <a href="<?php echo 'show.php?id=' . (int)($key + 1); ?>">
                                <?php echo $obj['title']; ?>
                            </a>
                        </td>
                        <td class="obj-item"><?php echo $obj['author']; ?></td>
                        <td class="obj-item"><?php echo $obj['available'] ? 'True' : 'False'; ?></td>
                        <td class="obj-item"><?php echo $obj['isbn']; ?></td>
                        <td>
                            <a href="<?php echo 'delete.php?id=' . (int)($key + 1); ?>">
                                <button class="btn-delete">Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="flex-container" style="justify-content: center;">
        <a href="<?php echo 'create.php' ?>">
            <button class="btn-create">Create</button>
        </a>
    </div>
</body>

</html>
<?php
require_once('connect.php');

$store_title = "Bookstore";

if (isset($_POST['submit'])) {
    $key = $_POST['key'];
    $query = $pdo->prepare('SELECT * FROM books WHERE title LIKE :key AND is_deleted = 0');
    $query->execute(['key' => '%' . $key . '%']);
    $results = $query->fetchAll();
    $rows = $query->rowCount();
} else {
    $stmt = $pdo->query('SELECT id, title FROM books WHERE is_deleted = 0');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/output.css">
</head>

<body>
    <style>
        h1 {
            color: red;
            font-size: 150px;
            margin: 5px 0;
        }

        ul {
            display: grid;
            gap: 5px;
            grid-template-columns: 1fr 1fr 1fr;
            font-size: 25px;
            margin: 5px 0;
        }

        .animate-character {
            font-family: 'Roboto', sans-serif;
            text-transform: uppercase;
            background-image: linear-gradient(-225deg,
                    #231557 0%,
                    #44107a 29%,
                    #ff1361 67%,
                    #fff800 100%);
            background-size: auto auto;
            background-clip: border-box;
            background-size: 200% auto;
            color: #fff;
            background-clip: text;
            text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textclip 2s linear infinite;
            display: inline-block;
            font-size: 150px;
        }

        .search_bar {
            width: 300px;
            height: 25px;
        }

        .submit_button {
            width: 100px;
            height: 31px;
            font-size: ;
        }

        @keyframes textclip {
            to {
                background-position: 200% center;
            }
        }
    </style>
    <h1 class="animate-character">
        <?php
        print $store_title;
        ?>
    </h1>
    <div class="w-full flex-row">
        <form method="POST" action="">
            <input class="search_bar bg-gray-200" type="text" placeholder="Search books.." name="key">
            <input class="submit_button border-2 border-black" type="submit" value="Submit" name="submit">
        </form>

    </div>
    <ul>
        <?php
        if (isset($stmt)) {
            while ($row = $stmt->fetch()) {
                echo "<li><a href='book.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></li>";
            }
        }
        ?>
    </ul>
    <ul>
        <?php
        if (isset($results)) {
            if ($rows != 0) {
                foreach ($results as $result) {
                    echo "<li class='underline '><a href='book.php?id=" . $result['id'] . "'>" . $result['title'] . "</a></li>";
                }
            } else {
                echo "No results";
            }
        }
        ?>
    </ul>
</body>

</html>
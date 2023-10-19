<?php
require_once('connect.php');

$stmt = $pdo->query('SELECT id, title FROM books');
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$hello = "Hello Monkeys!"
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        h1 {
            color: red;
            font-size: 250px;
        }

        .animate-character {
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
            font-size: 190px;
        }

        @keyframes textclip {
            to {
                background-position: 200% center;
            }
        }
    </style>
    <h1 class="animate-character">
        <?php
        print $hello;
        ?>
    </h1>
    <ul>
        <?php
        while ($row = $stmt->fetch()) {
            echo "<li><a href='book.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></li>";
        }
        ?>
    </ul>
</body>

</html>
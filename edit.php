<?php
require_once('connect.php');

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $release_date = $_POST['release_date'];
    $author = $_POST['author'];

    $stmt = $pdo->prepare('UPDATE books SET title = :title, release_date = :release_date WHERE id = :id');
    $stmt->execute(['title' => $title, 'release_date' => $release_date, 'id' => $id]);

    $stmt = $pdo->prepare('UPDATE book_authors SET author_id = :author WHERE book_id = :id');
    $stmt->execute(['author' => $author, 'id' => $id]);

    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

$stmt = $pdo->prepare('SELECT * FROM book_authors ba LEFT JOIN authors a ON ba.author_id=a.id WHERE book_id = :id');
$stmt->execute(['id' => $id]);

?>

<h1>Muuda</h1>
<form method="POST">
    <label for="title">Pealkiri</label>
    <input type="text" name="title" value="<?php echo $books['title']; ?>">

    <label for="release_date">Väljalaske kuupäev</label>
    <input type="date" name="release_date" value="<?php echo $books['release_date']; ?>">

    <label for="author">Autor</label>
    <input type="text" name="autor" value="<?php echo $books['author']; ?>">

    <button type="submit">Salvesta</button>
</form>
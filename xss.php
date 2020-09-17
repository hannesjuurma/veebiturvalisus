<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum - XSS</title>
</head>
<body>
<h1>Forum</h1>
<form method="post">
    Heading: <input type="text" name="title">
    <br>
    Content: <input type="text" name="content">
    <br>
    <button type="submit">Add post</button>

    <h2>Forum posts</h2>
</form>
</body>
</html>

<?php
# Pange siia oma database andmed ise >:|
$conn = new mysqli("localhost", "", "", "");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$content = $_POST['content'];

# Loo posts tabel koos struktuuriga "title, content" või lisa täiesti oma struktuur.
$sqlPosts = " SELECT * FROM posts ";
$sqlSubmit = "INSERT INTO posts (title, content) VALUES('".$title."', '".$content."');";

// Submit a post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postAdded = $conn->query($sqlSubmit);
    if (!$postAdded) {
        echo "Failed to add a post!";
    }

}

// Display all posts
$getPosts = $conn->query($sqlPosts);

if ($getPosts->num_rows > 0) {
    // output data of each row
    while($row = $getPosts->fetch_assoc()) {
        echo "
        <div style='margin-top: 30px; border:1px solid black';>
         Header: ".$row['title']."<br>
         Content: ".$row['content']."
        </div>";
    }
} else {
    echo "Couldn't find any posts!";
}
?>

<?php

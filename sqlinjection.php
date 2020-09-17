<?php
# Pange siia oma database andmed ise >:|
$conn = new mysqli("localhost", "", "", "");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['username'];
$password = $_POST['password'];

# Lisa "TABLENAME" asemele tabel, kus kasutajate andmeid hoitakse.
$sql = " SELECT * FROM TABLENAME where username = '$username' AND password = '$password'";
// echo $sql . '<br>'; <-- Sellega saab kontrollida SQL lause seisu

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Output data as: id / name / password
    while ($row = $result->fetch_assoc()) {
        $output = "Logged in as: id: " . $row["userid"] . " / Name: " . $row["username"] . " / Password: " . $row["password"] . "<br>";
    }
} else {
    $output = "Username or password is invalid!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - SQL Injection</title>
</head>
<body>
<h1>Log in!</h1>
<form method="post">
    Username: <input type="text" name="username">
    <br>
    Password: <input type="text" name="password">
    <br>
    <button type="submit">Log in</button>
    <div style="margin-top: 20px;"><?php echo $output ?></div>
</form>
</body>
</html>





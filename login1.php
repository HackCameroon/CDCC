<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=cdcc', 'root', 'NuY1Yq1jeA3U');
 
if(isset($_GET['login'])) {
    $username = $_POST['username'];
    $passwort = $_POST['passwort'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE name = '".$username."'");
    $result = $statement->execute();
    $user = $statement->fetch();
        
    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['name'];
        die('Login erfolgreich. Weiter zu <a href="teststelle.php">internen Bereich</a>');
    } else {
        $errorMessage = "Name oder Passwort war ungültig<br>";
    }
    
}
?>
<!DOCTYPE html> 
<html> 
<head>
  <title>Login</title>    
</head> 
<body>
 <h1>Login1</h1>
<?php 
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
 
<form action="?login=1" method="post">
E-Mail:<br>
<input type="username" size="40" maxlength="250" name="username"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>
 
<input type="submit" value="Abschicken">
</form> 
</body>
</html>
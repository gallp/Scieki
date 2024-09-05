<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$password_err = $confirm_password_err = "";
$success = "";

//check if this page was accesed via POST method, if not redirect to login page
// if(!$_SERVER["REQUEST_METHOD"] == "POST"){
//     header("location: login.php");
//     exit;
// }

// echo var_dump($_POST) ;
// echo "request was post";

// echo var_dump($_SESSION);

// Include config file
require_once "config.php";

//$username = $_SESSION["username"];
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("s",$_SESSION["username"]);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$id = $result["id"];

if($_SERVER["REQUEST_METHOD"] == "POST"){

$password = trim($_POST["password"]);
    // Validate password
if(empty(trim($_POST["password"]))){
    $password_err = "Hasło nie może być puste";     
} elseif(strlen(trim($_POST["password"])) < 6){
    $password_err = "Hasło nie może być krótsze niż 6 znaków";
}

// Validate confirm password
if(empty(trim($_POST["confirm_password"]))){
    $confirm_password_err = "Proszę potwierdzić hasło";     
} else{
    $confirm_password = trim($_POST["confirm_password"]);
    if($password != $confirm_password){
        $confirm_password_err = "Podane hasła są różne";
    }else{

        $param_password = password_hash($password, PASSWORD_DEFAULT);

// echo $param_password;

        $sql = "UPDATE users SET password=? WHERE id=?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("si",$param_password, $id);
        $stmt->execute();
        $success = "1";
// echo "password changed for uid = " . $id;

        $stmt->close();
        $link->close();
        }
}

// if($password != NULL && $confirm_password !=NULL && $password == $confirm_password ){

// header("location: sciekin.php");
// }

// echo "pasword_err is " . $password_err;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php require_once "navbar.php";?>
    <div class="body-middle">
        <div class="container">
            <header>
                Zmiana hasła
            </header>
            <?php 
            
              echo empty($success) ? "<p>Aby zmienić hasło wypełnij formularz</p>": "<span style='color:green;font-weight:bolder'>Hasło zostało zmienione</span>";
            
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    
                    <div class="input-box">
                        <label for="username" >Wpisz nowe hasło</label>
                        <input type="password" id="password" name="password">
                        <span style="color:red;font-weight:bolder"><?php if(!empty($password_err)){echo $password_err;}?></span>           
                    </div>    
                    <div class="input-box">
                        <label for="password">Potwierdź nowe hasło</label>
                        <input type="password" id="confirm_password" name="confirm_password">
                        <span style="color:red;font-weight:bolder"><?php if(!empty($confirm_password_err)){echo $confirm_password_err;}?></span>
                    </div>               
                        <input type="hidden" id="submit" name="submit" value="1">
                    <div class="input-box-group">
                        <div class="input-group">
                            <input type="submit" class="btn btn-send" value="Zmień">
                        </div>
                        
                    </div>
                </form>
        </div>
    </div>        
</body>
</html>
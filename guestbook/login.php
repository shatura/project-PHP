<?php


include_once ("config.php");



if (!empty($_SESSION['user_id'])){
    header('location: /index.php');
}
$errors = [];
$isRegisters = 0;
if(!empty($_GET['registration'])){
    $isRegisters = 1;

}

if(!empty($_POST)){
    if(empty($_POST['user_name'])){
        $errors[]='Please enter User Name / Email';
    }
    if(empty($_POST['password'])){
        $errors[]='Please enter password';
    }
    if (empty($errors)){
        $user = new User();
        $user = $user->chekLogin($_POST['user_name'], sha1($_POST['password'].SALT));
        if (!empty($user->id)) {
            $_SESSION['user_id'] = $user->id;
            header("location: /index.php");
        }else
        {
            $errors[]= 'Please enter valid credentails';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> My Guest Book </title>
    <meta charset="UTF-8">
</head>
<body>
    <?php if(!empty($isRegisters)) :?>
    <h2> Вы успешно зареистировались! Используйте свои данные для входа на сайт</h2>
    <?php endif;?>
    <h1>Log in Page</h1>
    <div>
        <form method="POST">
            <div style="color: red">
                <?php foreach ($errors as $error) :?>
                <p><?php echo $errors;?></p>
                <?php endforeach;?>
            </div>
            <div>
                <label> User Name / Email </label>
                <div>
                    <input type="text" name="user_name" required="" value="<?php echo (!empty($_POST['user_name']) ? $_POST['user_name'] : '');?>"/>
                </div>
            </div>
            <div>
                <label>Password</label>
                <div>
                    <input type="password" name="password" required="" value=""/>
                </div>
            </div>
            <div>
                <br/>
                <input type="submit" name="submit" value="Log In">
            </div>
        </form>
    </div>
</body>
</html>


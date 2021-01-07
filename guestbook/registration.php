<?php
    require_once ('config.php');

        if (!empty($_SESSION['user_id'])){
        header("local:/index.php ");
        }
    $errors = [];
    if(!empty($_POST)){
        $validator = new Volidator(new DB());
        foreach ($_POST as $k=>$v) {
            $validator->checkEmpty($k,$v);
        }

        $validator->checkMaxLength('user_name', $_POST['user_name'], 'users', 'username');
        $validator->checkMaxLength('first_name',$_POST['first_name'], 'users', 'first_name');
        $validator->checkMaxLength('last_name',$_POST['last_name'], 'users', 'last_name');
        $validator->checkMinLength('password',$_POST['password'], 6);
        $validator->checkMatch('password',$_POST['password'], 'confirm_password', $_POST['confirm_password']);
        $errors = $validator->errors;

        if (empty($errors)){
            $user = new User();
            $user->userName= $_POST['user_name'];
            $user->email=$_POST['email'];
            $user->password=sha1($_POST['password'].SALT);
            $user->firstName=$_POST['first_name'];
            $user->lastName=$_POST['last_name'];
            $user->save();
            header("local: /login.php?registration=1");
        }
    }
?>

<!DOCTYPE html>
    <html>
    <head>
        <title>My Guest Book</title>
        <meta charset="UTF-8">
    </head>>
    <body>
    <h1>Registration</h1>>
    <div>
        <form method="POST">
            <div style="color:red;">
                <?php foreach ($errors as$error) :?>
                    <p><?php echo $error;?></p>
                <?php endforeach;?>
            </div>
            <div>
                <label> User Name: </label>>
                <div>
                    <input type="text" name = "user_name" required="" value= " <?php echo (!empty($_POST['user_name']) ? $_POST['user_name'] : '');?>" />
                </div>
            </div>

            <div>
                <label> Email: </label>>
                <div>
                    <input type="email" name = "email" required="" value=""  " <?php echo (!empty($_POST['email']) ? $_POST['email'] : '');?>" />
                </div>
            </div>

            <div>
                <label> First Name:  </label>
                <div>
                    <input type="text" name = "first_name" required="" value= " <?php echo (!empty($_POST['first_name']) ? $_POST['first_name'] : '');?>" />
                </div>
            </div>

            <div>
                <label> Last Name:  </label>
                <div>
                    <input type="text" name = "last_name" required="" value= " <?php echo (!empty($_POST['last_name']) ? $_POST['last_name'] : '');?>" />
                </div>
            </div>

            <div>
                <label> Password: </label>
                <div>
                    <input type="password" name="password" required="" value=""  />
                </div>
            </div>

            <div>
                <label> Confirm Password </label>
                <div>
                    <input type="password" name="confirm_password" required="" value=""  />
                </div>
            </div>

            <div>
                <br/>
                <input type="submit" name="submit" value="Register">
            </div>
        </form>
    </div>
    </body>
</html>

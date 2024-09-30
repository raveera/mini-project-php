<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>Login</h1>
        <form action="<?= USER_CONTROLLER_PATH . '?page=login'; ?>" method="POST">
            Username : <input type="text" name="username" value="<?= $username; ?>" required/>
            Password : <input type="password" name="password" value="<?= $password;?>" required/>
            <button type="submit" name="action" value="login">Login</button>
        </form>
        <p style="color: #ff0000">
            <?= $err; ?>
        </p> 
        <a href="<?= USER_CONTROLLER_PATH . '?page=register'; ?>">Register Here</a>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
    </head>
    <body>
        <h1>Register</h1>
        <form action="<?= USER_CONTROLLER_PATH . '?page=register'; ?>" method="POST">
            Username *: <input type="text" name="username" value="<?= $username ?>" required />
            Password *: <input type="password" name="password" required/>
            Name *: <input type="text" name="name" value="<?= $name?>" required />
            <button type="submit" name="action" value="register">Register</button>
        </form>
        <p style="color: #ff0000">
            <?= $err ? $err : ''?>
        </p> 
        <a href="<?= USER_CONTROLLER_PATH . '?page=login'; ?>"> Login Here </a>
    </body>
</html>

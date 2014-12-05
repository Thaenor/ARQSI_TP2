<?php include 'includes/overall/Header.php' ?>

<h1>Register</h1>
<p>Registation page</p>

<br><br>

<form action="RegisterController.php" method="post">
    <ul id="register">
        <li>
            Username: <br/>
            <input type="text" name="username">
        </li>
        <li>
            Password: <br/>
            <input type="password" name="password">
        </li>
        <li>
            Retype Password: <br/>
            <input type="password" name="REpassword">
        </li>
        <li>
            <input type="submit" value="log in">
        </li>
    </ul>
</form>

<?php include 'includes/overall/Footer.php' ?>

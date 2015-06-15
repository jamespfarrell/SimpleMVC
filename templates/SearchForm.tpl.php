<form id="searchForm" action="register.php" method="post">
    <p><label>Email address</label><input <?php if ($emailError <> "") echo "class='errorInput'";?> id="email" name="email" type="text" <?php if (isset($_SESSION['thisEmail'])) echo "value='".$_SESSION['thisEmail']."'";?>/><?php if ($emailError <> "") echo "<span class='error'>$emailError</span>";?></p>
    <p><label>Name</label><input <?php if ($nameError <> "") echo "class='errorInput'";?> id="name" name="name" type="text" <?php if (isset($_SESSION['thisName'])) echo "value='".$_SESSION['thisName']."'";?>/><?php if ($nameError <> "") echo "<span class='error'>$nameError</span>";?></p>
    <p><label>Password</label><input <?php if ($passwordError <> "") echo "class='errorInput'";?> id="password" name="password" type="password" /><?php if ($passwordError <> "") echo "<span class='error'>$passwordError</span>";?></p>
    <p><label>Password repeat</label><input <?php if ($passwordError <> "") echo "class='errorInput'";?> id="passwordRepeat" name="passwordRepeat" type="password" /><?php if ($passwordError <> "") echo "<span class='error'>$passwordError</span>";?></p>
    <input id="action" name="action" type="hidden" value="registerSubmit"/>
    <input type="submit" name="submit" id="submitButton"/>
</form>
<p style="color:red">{ScreenMessage}</p>

<form id="searchForm" action="/auth/postRegister" method="post">
    <div class="form-group">
        <label for="usr">Email address:</label>
        <input class="{EmailInputClass}"  class="form-control" id="email" name="email" type="text" value="{EmailInputValue}"/><span class="errorMessage">{EmailInputErrorMessage}</span>
    </div>
    <div class="form-group">
        <label for="usr">Name:</label>
        <input class="{NameInputClass}"  class="form-control" id="name" name="name" type="text" value="{NameInputValue}"/><span class="errorMessage">{NameInputErrorMessage}</span>
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input class="{PasswordInputClass}"  class="form-control" id="password" name="password" type="password" /><span class="errorMessage">{PasswordInputErrorMessage}</span>

    </div>
    <div class="form-group">
        <label for="pwd">Password repeat:</label>
        <input class="{PasswordRepeatInputClass}" id="passwordRepeat" name="passwordRepeat" type="password" /><span class="errorMessage">{PasswordRepeatInputErrorMessage}</span>

    </div>

    <input id="action" name="action" type="hidden" value="registerSubmit"/>
    <input type="submit" name="submit" id="submitButton"/>
</form>

<style>
    .errorMessage {
        color:red;
        margin-left: 20px;
    }

</style>
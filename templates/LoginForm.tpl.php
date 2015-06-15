
        <form id="searchForm" action="/auth/postLogin" method="post">
            <p><label>Email address</label><input id="email" name="email" type="text" /></p>
            <p><label>Password</label><input id="password" name="password" type="password" /></p>
            <input id="action" name="action" type="hidden" value="loginSubmit"/>
            <input type="submit" name="submit" id="submitButton"/>
        </form>
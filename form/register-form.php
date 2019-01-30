<form action="./register.php" method="post">
    <div>
        <div class="form-group">
            <label class="form-control-label required" for="username">Username</label>
            <input type="text" id="username" name="username" required="required" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-control-label required" for="email">Email</label>
            <input type="email" id="email" name="email" required="required" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-control-label required" for="password">Password</label>
            <input type="password" id="password" name="password" required="required" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-control-label required" for="cpassword">Reenter Password</label>
            <input type="password" id="cpassword" name="cpassword" required="required" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" id="register" name="register" class="btn-secondary btn">Register</button>
        </div>
    </div>
</form>
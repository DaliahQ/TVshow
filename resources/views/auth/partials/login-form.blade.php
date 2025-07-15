<!-- Login Form -->
<form id="login-form">
    @csrf
    <div class="mb-3">
        <label for="login-email">Email address</label>
        <input id="login-email" type="email" class="form-control" name="email" required autofocus>
        <div class="invalid-feedback" id="login-email-error"></div>
    </div>
    <div class="mb-3">
        <label for="login-password">Password</label>
        <input id="login-password" type="password" class="form-control" name="password" required>
        <div class="invalid-feedback" id="login-password-error"></div>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>

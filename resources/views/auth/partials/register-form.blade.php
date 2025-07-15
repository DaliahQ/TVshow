<!-- Register Form -->
<form id="register-form" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="register-name">Name</label>
        <input id="register-name" type="text" class="form-control" name="name" required autofocus>
        <div class="invalid-feedback" id="register-name-error"></div>
    </div>
    <div class="mb-3">
        <label for="register-email">Email address</label>
        <input id="register-email" type="email" class="form-control" name="email" required>
        <div class="invalid-feedback" id="register-email-error"></div>
    </div>
    <div class="mb-3">
        <label for="register-password">Password</label>
        <input id="register-password" type="password" class="form-control" name="password" required>
        <div class="invalid-feedback" id="register-password-error"></div>
    </div>
    <div class="mb-3">
        <label for="register-password_confirmation">Confirm Password</label>
        <input id="register-password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>
    <div class="mb-3">
        <label for="register-profile_image">Profile Image</label>
        <input id="register-profile_image" type="file" class="form-control" name="profile_image" required>
        <div class="invalid-feedback" id="register-profile_image-error"></div>
    </div>
    <button type="submit" class="btn btn-success w-100">Sign Up</button>
</form>

<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control" name="name" required autofocus>
        @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email">Email address</label>
        <input id="email" type="email" class="form-control" name="email" required>
        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control" name="password" required>
        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>
    <div class="mb-3">
        <label for="profile_image">Profile Image</label>
        <input id="profile_image" type="file" class="form-control" name="profile_image" required>
        @error('profile_image')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-success w-100">Sign Up</button>
</form>

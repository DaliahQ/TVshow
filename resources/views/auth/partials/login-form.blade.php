<form  method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label for="email">Email address</label>
        <input id="email" type="email" class="form-control" name="email" required autofocus>
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

    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>

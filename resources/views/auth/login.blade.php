<x-guest-layout>
    <div class="login-wrapper">
        <div class="login-container">
            <!-- Loading Indicator -->
            <div id="loading-overlay" class="loading-overlay">
                <div class="spinner"></div>
            </div>

            <!-- Login Form -->
            <div class="login-form">
                <h2>Login</h2>
                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf
                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="error-message" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="error-message" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-primary">
                        Log in
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include JS for Form Submission -->
    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            document.getElementById('loading-overlay').classList.add('active');
        });
    </script>
</x-guest-layout>

<!-- resources/views/reset-password.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reset kata sandi</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu,
                Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background: linear-gradient(to bottom, #f0f2f5, #c9d6df);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 300px;
            text-align: center;
        }
        .icon-container {
            background-color: #e6e6e6;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }
        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .input-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: none; /* Hidden by default */
        }
        .btn-primary {
            background-color: #0f172a;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            width: 100%;
        }
        .btn-secondary {
            background-color: transparent;
            color: #333;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        .btn-primary:hover {
            background-color: #1e293b;
        }
        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
            </svg>
        </div>
        <h2 class="title">Buat kata sandi baru</h2>

        <form action="{{ route('reset.proses') }}" method="POST" id="resetPasswordForm">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label class="form-label" for="password">Kata Sandi</label>
                <div class="input-container">
                    <input type="password" name="password" class="form-input" id="password" required />
                    <button type="button" class="password-toggle" id="togglePassword" aria-label="Toggle Password Visibility">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                <p class="error-message" id="passwordError"></p>
            </div>

            <div class="form-group">
                <label class="form-label" for="confirmPassword">Konfirmasi kata sandi baru</label>
                <div class="input-container">
                    <input type="password" name="password_confirmation" class="form-input" id="confirmPassword" required />
                    <button type="button" class="password-toggle" id="toggleConfirmPassword" aria-label="Toggle Password Visibility">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                <p class="error-message" id="confirmPasswordError"></p>
            </div>

            <button type="submit" class="btn-primary">Konfirmasi</button>
            <button type="button" class="btn-secondary" id="backButton">Kembali</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cek email di localStorage
            const resetEmail = localStorage.getItem('resetEmail');
            if (!resetEmail) {
                alert('Silakan masukkan email terlebih dahulu');
                window.location.href = '{{ url("/lupakatasandi") }}';
                return;
            }

            function setupPasswordField(inputId, toggleId) {
                const passwordInput = document.getElementById(inputId);
                const toggleButton = document.getElementById(toggleId);

                // Tampilkan tombol toggle jika ada isi input
                passwordInput.addEventListener('input', function () {
                    toggleButton.style.display = this.value.length > 0 ? 'block' : 'none';
                });

                // Toggle type password/text
                toggleButton.addEventListener('click', function () {
                    const type = passwordInput.type === 'password' ? 'text' : 'password';
                    passwordInput.type = type;

                    const eyeIcon = this.querySelector('.eye-icon');
                    if (type === 'password') {
                        eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
                    } else {
                        eyeIcon.innerHTML =
                            '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
                    }
                });

                if (passwordInput.value.length > 0) {
                    toggleButton.style.display = 'block';
                }
            }

            setupPasswordField('password', 'togglePassword');
            setupPasswordField('confirmPassword', 'toggleConfirmPassword');

            const form = document.getElementById('resetPasswordForm');
            form.addEventListener('submit', function (e) {
                // Validasi client side sebelum submit form
                const password = document.getElementById('password').value.trim();
                const confirmPassword = document.getElementById('confirmPassword').value.trim();

                document.getElementById('passwordError').style.display = 'none';
                document.getElementById('confirmPasswordError').style.display = 'none';

                if (password.length < 8) {
                    const err = document.getElementById('passwordError');
                    err.textContent = 'Kata sandi minimal harus 8 karakter';
                    err.style.display = 'block';
                    e.preventDefault();
                    return false;
                }
                if (password !== confirmPassword) {
                    const err = document.getElementById('confirmPasswordError');
                    err.textContent = 'Kata sandi tidak cocok';
                    err.style.display = 'block';
                    e.preventDefault();
                    return false;
                }
                // validasi oke, form submit ke Laravel
            });

            document.getElementById('backButton').addEventListener('click', function () {
                window.location.href = '{{ url("/lupakatasandi") }}';
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f5f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
            width: 320px;
            text-align: center;
        }
        
        .icon-circle {
            background-color: #e0e0e0;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
        }
        
        h2 {
            font-size: 18px;
            color: #222;
            margin-bottom: 10px;
        }
        
        p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        .btn-primary {
            background-color: #000022;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;
        }
        
        .btn-back {
            background: none;
            border: none;
            color: #000022;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }
        
        .label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-size: 14px;
            color: #444;
        }
        
        .forgot-link {
            display: block;
            text-align: right;
            font-size: 12px;
            color: #000022;
            text-decoration: none;
            margin-top: -10px;
            margin-bottom: 15px;
        }
        
        .password-container {
            margin-bottom: 15px;
        }
        
        /* Password field styling */
        .password-field {
            position: relative;
            margin-bottom: 10px;
        }
        
        .password-field input {
            margin-bottom: 0;
        }
        
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(15%);
            cursor: pointer;
            color: #666;
            display: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-circle">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4C13.1 4 14 4.9 14 6V8H10V6C10 4.9 10.9 4 12 4ZM8 8V6C8 3.8 9.8 2 12 2C14.2 2 16 3.8 16 6V8H17C18.1 8 19 8.9 19 10V20C19 21.1 18.1 22 17 22H7C5.9 22 5 21.1 5 20V10C5 8.9 5.9 8 7 8H8Z" fill="#555555"/>
            </svg>
        </div>
        <h2>Ubah kata sandi</h2>
        <br><br>
        
        <form>
            <div class="password-field">
                <label for="current-password" class="label">Kata sandi saat ini</label>
                <input type="password" id="current-password" oninput="checkPasswordInput('current-password')" required>
                <i class="toggle-password fas fa-eye-slash" id="toggle-current-password" onclick="togglePassword('current-password')"></i>
            </div><br>
            <a href="{{ url('/lupakatasandi') }}" class="forgot-link">Lupa kata sandi?</a>
            
            <div class="password-field">
                <label for="new-password" class="label">Kata sandi baru</label>
                <input type="password" id="new-password" oninput="checkPasswordInput('new-password')" required>
                <i class="toggle-password fas fa-eye-slash" id="toggle-new-password" onclick="togglePassword('new-password')"></i>
            </div>
            
            <div class="password-field">
                <p id="password-error" style="color: red; font-size: 12px; display: none;">Kata sandi tidak cocok!</p>

                <label for="confirm-password" class="label">Konfirmasi kata sandi baru</label>
                <input type="password" id="confirm-password" oninput="checkPasswordInput('confirm-password')" required>
                <i class="toggle-password fas fa-eye-slash" id="toggle-confirm-password" onclick="togglePassword('confirm-password')"></i>
            </div>
            
            <br>
            <button type="submit" class="btn-primary">Konfirmasi</button>
            <a href="{{ url('/editprofil') }}" class="btn-back">Kembali</a>
        </form>
    </div>

    <script>
        function checkPasswordInput(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById('toggle-' + fieldId);
            
            
            if(passwordInput.value.length > 0) {
                toggleIcon.style.display = 'block';
            } else {
                toggleIcon.style.display = 'none';
            }
        }

        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById('toggle-' + fieldId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }

        document.querySelector("form").addEventListener("submit", function(event) {
    const newPassword = document.getElementById("new-password");
    const confirmPassword = document.getElementById("confirm-password");

    if (newPassword.value !== confirmPassword.value) {
        confirmPassword.setCustomValidity("Passwords do not match!");
        event.preventDefault(); // Mencegah submit jika tidak sesuai
    } else {
        confirmPassword.setCustomValidity(""); // Reset error jika sudah benar
        window.location.href = "{{ url('/beranda') }}"; // Redirect ke halaman beranda
        event.preventDefault(); // Mencegah reload form agar tidak kehilangan data
    }
});


// Menghapus pesan error saat pengguna mengetik ulang password
document.getElementById("confirm-password").addEventListener("input", function() {
    this.setCustomValidity("");
});


    </script>
</body>
</html>
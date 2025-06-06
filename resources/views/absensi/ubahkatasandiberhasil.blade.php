<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kata sandi berhasil</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
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
            margin-bottom: 10px;
        }
        .message {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
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
        .btn-primary:hover {
            background-color: #1e293b;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <h2 class="title">Kata sandi di ubah!</h2>
        <p class="message">Kata sandi Anda telah berhasil diubah. Klik di bawah ini untuk melanjutkan akses Anda.
        </p>
        
        <button type="button" class="btn-primary" id="continueButton">Lanjut</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if password was reset
            const newPasswordSet = localStorage.getItem('newPasswordSet');
            if (!newPasswordSet) {
                // Redirect to the forgot password page if no password was set
                alert('Please complete the password reset process');
                window.location.href = "{{ url('/lupakatasandi') }}";
            }
        });
        
        document.getElementById('continueButton').addEventListener('click', function() {
            // Clear the localStorage items used for the reset flow
            localStorage.removeItem('resetEmail');
            localStorage.removeItem('newPasswordSet');
            
            // Redirect to the login page
            window.location.href = "{{ url('/login') }}";
        });
    </script>
</body>
</html>
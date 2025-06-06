<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa kata sandi</title>
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
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 14px;
            color: #666;
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
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
        </div>
        <h2 class="title">Lupa kata sandi?</h2>
        <p class="subtitle">Masukan email anda untuk reset </p>
        
        <form id="forgotPasswordForm">
            <div class="form-group">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-input" id="email" placeholder="Masukan email anda" required>
            </div>
            
            <button type="submit" class="btn-primary">Konfirmasi</button>
            <button type="button" class="btn-secondary" id="backButton">Kembali</button>
        </form>
    </div>

    <script>
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            
            // Store email in localStorage to simulate session
            localStorage.setItem('resetEmail', email);
            
            // Redirect to the reset password page
            window.location.href = "{{ url('/resetkatasandi') }}";
        });
        
       
        
        document.getElementById('backButton').addEventListener('click', function() {
            window.location.href = 'login.html';
        });
    </script>
</body>
</html>
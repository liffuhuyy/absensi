<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html,
        body {
            min-height: 100vh;
            width: 100%;
            background: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            /* Kurangi padding */
        }

        .wrapper {
            width: 95%;
            /* Hampir penuh, agar tidak jauh dari sisi layar */
            max-width: 500px;
            /* Lebih besar di layar lebar */
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .wrapper .title {
            font-size: 30px;
            text-align: center;
            line-height: 75px;
            background: linear-gradient(-135deg, #011023, #042857);
            color: #fff;
            border-radius: 15px 15px 0 0;
        }

        .wrapper form {
            padding: 20px;
        }

        .wrapper form .field {
            position: relative;
            margin-bottom: 18px;
        }

        .wrapper form .field input {
            width: 100%;
            padding: 14px 20px;
            font-size: 18px;
            border: 1px solid #ccc;
            border-radius: 25px;
        }

        .wrapper form .field label {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #999;
            pointer-events: none;
            transition: 0.3s;
        }

        .wrapper form .field input:focus,
        .wrapper form .field input:valid {
            border-color: #4158d0;
        }

        .wrapper form .field input:focus~label,
        .wrapper form .field input:valid~label {
            top: 0;
            font-size: 13px;
            background: #fff;
            padding: 0 5px;
            color: #4158d0;
        }

        .wrapper form .field input[type="submit"] {
            background: linear-gradient(-135deg, #011023, #042857);
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: 0.3s;
        }

        .wrapper form .field input[type="submit"]:active {
            transform: scale(0.97);
        }

        form .content {
            text-align: center;
            font-size: 15px;
            margin-top: 10px;
        }

        form .pass-link a {
            color: #4158d0;
            text-decoration: none;
        }

        form .pass-link a:hover {
            text-decoration: underline;
        }


        /* ✅ Tambahan agar lebih enak di HP */
        @media (max-width: 480px) {
            .wrapper .title {
                font-size: 24px;
                line-height: 60px;
            }

            .wrapper form {
                padding: 15px;
            }

            .wrapper form .field input {
                font-size: 15px;
                padding: 10px 16px;
            }

            .wrapper form .field label {
                font-size: 14px;
            }

            .wrapper form .field input:focus~label,
            .wrapper form .field input:valid~label {
                font-size: 12px;
            }
        }
    </style>
</head>

<body style="margin: 10; padding: 10;">
    <div class="wrapper">
        <div class="title">
            LOGIN
        </div>

        {{-- Notifikasi Error --}}
        @if ($errors->any())
            <div class="alert alert-danger text-center px-3" style="color: red; margin-top: 10px;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            {{-- Email --}}
            <div class="field">
                <input type="text" name="email" id="email" value="{{ old('email') }}" required>
                <label for="email">Email</label>
            </div>

            {{-- Password --}}
            <div class="field">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>

            {{-- Tombol Login --}}
            <div class="field mt-3">
                <input type="submit" value="masuk">
            </div>

            {{-- Lupa Password --}}
            <div class="content mt-2">
                <div class="pass-link">
                    <a href="{{ url('/lupakatasandi') }}">Lupa kata sandi?</a>
                </div>
            </div>
        </form>
    </div>
</body>

<!-- Script untuk mengatur fungsi toggle password dan tampilan ikon -->
<script>
    function validateFields() {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loginButton = document.getElementById('loginButton');

        // Enable the login button only if both fields are not empty
        if (emailInput.value.trim() !== '' && passwordInput.value.trim() !== '') {
            loginButton.disabled = false;
        } else {
            loginButton.disabled = true;
        }
    }

    // Event listeners for the input fields
    document.getElementById('email').addEventListener('input', validateFields);
    document.getElementById('password').addEventListener('input', validateFields);
</script>

</body>

</html>

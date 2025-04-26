
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #FFB900, #FF4D00);
            font-family: 'Poppins', sans-serif;
            margin: 0px;
        }
        .form-container {
            background: #1A1A1D;
            padding: 46px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #FFC300;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            font-weight: bold;
            color: #FFD60A;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 2px solid #FF8C00;
            border-radius: 8px;
            outline: none;
            background: #333;
            color: #FFD60A;
            transition: 0.3s;
        }
        input:focus {
            border-color: #FFD700;
        }
        .error {
            color: #FF4D00;
            font-size: 14px;
        }
        button {
            background: #FFD700;
            color: #1A1A1D;
            padding: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 50%;
            font-size: 16px;
            transition: 0.3s;
        }
        button:hover {
            background: #FFA500;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
                <label for="na">Name</label>
                <input type="text" id="na" name="name" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="ma">Email</label>
                <input type="email" id="ma" name="email" placeholder="Enter Email ID">
            </div>
            <div class="form-group" style="position: relative;">
                <label for="pa">Password</label>
                <input type="password" id="pa" name="password" placeholder="Enter Password">
                <span id="togglePassword" style="position: absolute; top: 38px; right: 10px; cursor: pointer;">
                    👁️
                </span>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#pa');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Optionally change the icon
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
</script>

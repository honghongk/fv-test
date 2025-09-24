<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-card {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 320px;
        }
        .login-card h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .login-card input {
            /* width: 100%; */
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-card button {
            /* width: 100%; */
            padding: 0.75rem;
            border: none;
            background: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-card button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }


        form{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>로그인</h2>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <input type="email" name="email" placeholder="이메일" required>
            <input type="password" name="password" placeholder="비밀번호" required>
            <button type="submit">로그인</button>
        </form>
    </div>

</body>
</html>

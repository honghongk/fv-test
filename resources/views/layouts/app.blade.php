<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- 기본 CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 960px;
            margin: 2rem auto;
            padding: 0 1rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        a {
            color: #3490dc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 0.5rem;
        }

        th {
            background-color: #f4f4f4;
        }

        button {
            padding: 0.4rem 0.8rem;
            background-color: #3490dc;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2779bd;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 0.4rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form div {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <main>
        @yield('content')
    </main>

    <!-- 기본 JS -->
    <script>
        // 필요 시 여기에 JS 코드 추가
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ToDoアプリ</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            background-color: #f3f4f6;
        }
        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .user-info {
            font-size: 0.9rem;
            color: #374151;
        }
        .logout-button {
            background: none;
            border: none;
            color: #ef4444; /* 赤色 */
            text-decoration: underline;
            cursor: pointer;
            margin-left: 15px;
            font-size: 0.9rem;
        }
        .logout-button:hover {
            color: #b91c1c;
        }
    </style>
</head>
<body>

    <header class="nav-bar">
        <div class="logo">
            <strong>ToDo List</strong>
        </div>
        
        <div class="user-info">
            @auth
                <span>ようこそ <strong>{{ Auth::user()->name }}</strong> さん</span>
                
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-button">
                        ログアウト
                    </button>
                </form>
            @endauth
        </div>
    </header>

    <div id="app"></div>

    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
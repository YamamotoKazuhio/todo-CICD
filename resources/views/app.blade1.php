<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to Laravel8 + React.js!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link href="/todo/css/app.css" rel="stylesheet">
    
    <style> .navbar{margin-bottom: 20px;} </style>
</head>
<body>
@auth
    <div style="margin-bottom: 10px; font-weight: bold;">
        ようこそ{{ Auth::user()->name }} さん
    </div>
@endauth
<form method="POST" action="{{ route('logout') }}" style="display: inline;">
    @csrf
    <button type="submit" style="background: none; border: none; color: blue; text-decoration: underline; cursor: pointer;">
        ログアウト
    </button>
</form>
  <div id="app"></div>
  <script src="/todo/js/app.js?v={{ time() }}" defer></script>
</body>
</html>

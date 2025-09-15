<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ユーザーログイン画面</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui, "Segoe UI", Roboto; margin:0; padding:40px; color:#222;}
    .wrap{max-width:820px; margin:0 auto; text-align:center;}
    h1{font-size:48px; font-weight:700; letter-spacing:.06em; margin:40px 0;}
    .field{max-width:840px; margin:26px auto;}
    input[type="email"], input[type="password"]{
      width:100%; font-size:28px; padding:22px 24px; box-sizing:border-box;
      border:1px solid #ccc; border-radius:6px;
    }
    .row{display:flex; gap:24px; justify-content:center; margin-top:40px;}
    .btn{
      min-width:220px; font-size:26px; padding:16px 24px; border-radius:28px;
      border:none; cursor:pointer; transition:opacity .15s;
    }
    .btn-primary{background:#10e0ee; color:#003544;}
    .btn-orange{background:#ff8a00; color:#fff;}
    .btn:hover{opacity:.85;}
    .error{color:#d33; margin-top:12px; font-size:14px;}
  </style>
</head>
<body>
<div class="wrap">
  <h1>ユーザーログイン画面</h1>

  @if ($errors->any())
    <div class="error">
      @foreach ($errors->all() as $e)
        <div>{{ $e }}</div>
      @endforeach
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="field">
      <input type="password" name="password" placeholder="パスワード" required>
    </div>

    <div class="field">
      <input type="email" name="email" placeholder="アドレス" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="row">
      <a class="btn btn-orange" href="{{ route('register') }}">新規登録</a>
      <button class="btn btn-primary" type="submit">ログイン</button>
    </div>
  </form>
</div>
</body>
</html>

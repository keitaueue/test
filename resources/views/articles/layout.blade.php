<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> @yield('title') - Test App Laravel 5.3</title>
</head>
<body>
    @if (!Auth::guest())
        ログインユーザ：{!! Auth::user()->name !!}
    @endif
    
    {!! link_to('', '一覧に戻る', ['class' => 'btn btn-primary']) !!}
    <br>

    @if (Auth::guest())
        {{-- ログインしていない時 --}}
        <li><a href="/auth/login">Login</a></li>
        <li><a href="/auth/register">Register</a></li>
    @else
        {{-- ログインしている時 --}}
        <!-- ドロップダウンメニュー -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="/auth/logout">Logout</a></li>
            </ul>
        </li>
    @endif




    @yield('content')

</body>
</html>

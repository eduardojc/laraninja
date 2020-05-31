<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Olá Mundo - @yield('title')</title>
    {{ Html::style('css/bootstrap.min.css') }}
    {{ Html::style('css/bootstrap-theme.min.css') }}
    {{ Html::style('css/styles.css')}}
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    {{ Html::script('js/jquery-3.4.1.min.js') }}
    {{ Html::script('js/bootstrap.js') }}
</body>
</html>
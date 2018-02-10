<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@lang('email.confirm_title')</title>
</head>
<body>
<h1>@lang('email.tnx') {{$user->name}}!</h1>

<p>
    @lang('email.confirm_body', ['route' => route('confirm', ['token' => $user->confirm_token])])
</p>
</body>
</html>
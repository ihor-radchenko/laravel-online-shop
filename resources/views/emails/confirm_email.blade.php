<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@lang('email.confirm_title')</title>
</head>
<body>
<h1>@lang('email.tnx') {{$user->name}}!</h1>

<p>
    @lang('email.go') <a href='{{ route('confirm', ['token' => $user->confirm_token]) }}'>@lang('email.to_link') </a>@lang('email.confirm_end')
</p>
</body>
</html>
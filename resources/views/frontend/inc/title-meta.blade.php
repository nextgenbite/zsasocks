<meta charset="utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<title>@if (!empty(trim($__env->yieldContent('title')))) @yield('title') | @endif{{ ucwords(isset($settings['app_name']) ? $settings['app_name'] : config('app.name')) }}</title>

<meta content="Nexgenbite" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset($settings['favicon'] ?? '/logo.png') }}">
@stack('meta')
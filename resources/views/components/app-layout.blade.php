<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/js/app.js'])
    {{-- Tailwind CDN（forms プラグイン込み） --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
    tailwind.config = {
    theme: {
      extend: {
       
      }
    }
    
  }
</script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    {{-- ナビバー（ロゴ / Dashboard / ユーザーメニュー） --}}
    @include('layouts.navigation')

    {{-- ページヘッダー（使わないなら何もセットしなければ非表示） --}}
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- ページ本体 --}}
    <main class="py-6">
        {{ $slot }}
    </main>
</div>
</body>
</html>
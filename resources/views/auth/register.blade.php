<x-guest-layout>
  <div class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold mb-8">ユーザー新規登録画面</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
      @csrf

      {{-- ユーザー名 --}}
      <div>
        <input name="name" type="text" value="{{ old('name') }}"
               placeholder="ユーザー名" class="form-input" required autofocus />
        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- メール --}}
      <div>
        <input name="email" type="email" value="{{ old('email') }}"
               placeholder="メールアドレス" class="form-input" required />
        @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- パスワード --}}
      <div>
        <input name="password" type="password"
               placeholder="パスワード" class="form-input" required />
        @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- 確認 --}}
      <div>
        <input name="password_confirmation" type="password"
               placeholder="パスワード確認" class="form-input" required />
      </div>

      {{-- ボタン行 --}}
      <div class="pt-4 flex justify-center gap-6">
        <a href="{{ route('login') }}" class="btn-secondary">戻る</a>
        <button type="submit" class="btn-primary">新規登録</button>
      </div>
    </form>
  </div>
</x-guest-layout>
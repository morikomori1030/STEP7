<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder="パスワード"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

     <div class="flex justify-center gap-4 mt-4">
  <a href="{{ route('register') }}"
     class="inline-flex items-center justify-center
            h-12 w-32 rounded-md border border-gray-300
            bg-white text-gray-800 font-semibold hover:bg-gray-100">
    新規登録
  </a>

  <button type="submit"
    class="inline-flex items-center justify-center
           h-12 w-32 rounded-md font-semibold
           bg-gray-900 text-white hover:bg-gray-800">
    ログイン
  </button>
    </div>
</form>
</x-guest-layout>

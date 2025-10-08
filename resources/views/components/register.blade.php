<x-guest-layout>
  <x-authentication-card>
    <x-slot name="logo">
      <x-authentication-card-logo />
    </x-slot>

    <x-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div>
        <x-label for="name" value="名前" />
        <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
      </div>

      <div class="mt-4">
        <x-label for="email" value="メールアドレス" />
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" required />
      </div>

      <div class="mt-4">
        <x-label for="password" value="パスワード" />
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
      </div>

      <div class="mt-4">
        <x-label for="password_confirmation" value="パスワード（確認）" />
        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
      </div>

      <div class="mt-6 flex items-center justify-end gap-3">
        <a href="{{ route('login') }}"
           class="inline-flex items-center px-6 py-3 rounded-md border border-gray-300
                  bg-white hover:bg-gray-100 text-gray-700 font-semibold">
          戻る
        </a>

        <button type="submit"
                class="px-6 py-3 bg-gray-900 text-white font-semibold rounded-md
                       hover:bg-gray-700 focus:outline-none focus:ring-2
                       focus:ring-gray-500 focus:ring-offset-2">
          新規登録
        </button>
      </div>
    </form>
  </x-authentication-card>
</x-guest-layout>
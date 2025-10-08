<button
  {{ $attributes->merge([
      'type' => 'submit',
      'class' => 'px-6 py-3 rounded-md font-semibold
                  !bg-gray-900 !text-white hover:!bg-gray-700
                  focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2'
  ]) }}>
  {{ $slot->isEmpty() ? 'ログイン' : $slot }}
</button>
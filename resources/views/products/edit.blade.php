@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="h4 mb-3">商品編集</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('products.update', $product) }}" method="post">
    @csrf
    @method('PUT')

    {{-- 共通フォーム部分 --}}
    @include('products._form', ['product' => $product])

    <button type="submit" class="btn btn-primary">更新する</button>
  </form>
</div>
@endsection

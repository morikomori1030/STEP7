@extends('layouts.app')

@section('content')
<div class="container">
  <h1>商品 新規登録</h1>
  <form action="{{ route('products.store') }}" method="POST">
    @include('products._form')
  </form>
</div>
@endsection

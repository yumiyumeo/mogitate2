@extends('layouts.app')

@section('title','商品一覧')

@section('sidebar')
  @include('partials.sidebar')
@endsection

@section('content')
  <div style="margin-top:2rem; display:flex; justify-content:space-between; align-items:center;">
    <h2>商品一覧</h2>
    <a href="{{ route('products.create') }}" class="btn-add">＋商品を追加</a>
  </div>

  <div class="cards-area">
    @forelse($products as $product)
      <a href="{{ route('products.edit',$product->id) }}" class="product-card">
        <div class="card-img-wrap">
          <img src="{{ asset('storage/products/' . $product->image) }}" width="100">
          <p>{{ $product->name }}</p>
          <p>{{ $product->price }}円</p>
          <p>{{ implode(', ', $product->seasons) }}</p>
        </div>
      </a>
    @empty
      <p>商品がありません。</p>
    @endforelse
  </div>

  <div class="pagination">
    {{ $products->links() }}
  </div>
@endsection

@extends('layouts.app')

@section('title', ($keyword ?? request('keyword','')) . ' の商品一覧')

@section('sidebar')
  @include('partials.sidebar')
@endsection

@section('content')
  <div style="margin-top:2rem; display:flex; justify-content:space-between; align-items:center;">
    <h2>{{ $keyword ?? request('keyword','') }} の商品一覧</h2>
    <a href="{{ route('products.create') }}" class="btn-add">＋商品を追加</a>
  </div>

  <div class="cards-area">
    @forelse($products as $product)
      <a href="{{ route('products.edit',$product->id) }}" class="product-card">
        <div class="card-img-wrap">
          <img src="{{ $product->image_path ? asset('storage/'.$product->image_path) : asset('images/placeholder.png') }}" alt="{{ $product->name }}">
        </div>
        <div class="card-meta">
          <div class="card-title">{{ $product->name }}</div>
          <div class="card-price">{{ number_format($product->price) }} 円</div>
        </div>
      </a>
    @empty
      <p>該当する商品はありませんでした。</p>
    @endforelse
  </div>

  <div class="pagination">
    {{ $products->links() }}
  </div>
@endsection

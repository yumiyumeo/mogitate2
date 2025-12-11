@extends('layouts.app')

@section('title','商品登録')

@section('sidebar')
  {{-- サイドバーはタイトル下に表示しない設計だが必要あれば include 可 --}}
@endsection

@section('content')
  <div style="margin-top:2rem;">
    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

      <div class="form-row">
        <label>商品名 <span class="badge-required">必須</span></label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
      </div>

      <div class="form-row">
        <label>値段 <span class="badge-required">必須</span></label>
        <input type="number" name="price" value="{{ old('price') }}" placeholder="値段を入力">
        @error('price') <div class="error-text">{{ $message }}</div> @enderror
      </div>

      <div class="form-row">
        <label>商品画像 <span class="badge-required">必須</span></label>
        <img id="create-preview" class="image-preview" src="" alt="" style="display:block; margin-bottom:8px; max-width:200px;">
        <input id="create-image" type="file" name="image" accept=".png,.jpeg">
        <div id="create-filename" style="font-size:13px; margin-top:6px;"></div>
        @error('image') <div class="error-text">{{ $message }}</div> @enderror
      </div>

      <div class="form-row">
        <label>季節 <span class="badge-required">必須</span> <span style="color:#A94442; margin-left:6px;">複数選択可</span></label>
        <div>
          @foreach(['春','夏','秋','冬'] as $s)
            <label style="margin-right:8px;"><input type="checkbox" name="seasons[]" value="{{ $s }}" {{ in_array($s, old('seasons',[])) ? 'checked':'' }}> {{ $s }}</label>
          @endforeach
        </div>
        @error('seasons') <div class="error-text">{{ $message }}</div> @enderror
      </div>

      <div class="form-row">
        <label>商品説明 <span class="badge-required">必須</span></label>
        <textarea name="description" placeholder="商品の説明を入力（120文字以内）">{{ old('description') }}</textarea>
        @error('description') <div class="error-text">{{ $message }}</div> @enderror
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn-back" onclick="history.back()">戻る</button>
        <button type="submit" class="btn btn-submit">登録</button>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function(){
      setupImagePreview('#create-image','#create-preview','#create-filename');
    });
  </script>
@endsection

@extends('layouts.app')

@section('title','商品編集')

@section('sidebar')
  {{-- ここにサイドバーを入れたい場合は include --}}
@endsection

@section('content')
  <div style="margin-top:2rem;">
    <div class="breadcrumbs" style="font-size:13px; color:#666; margin-bottom:8px;">
      <a href="{{ route('products.index') }}">商品一覧</a> &raquo; 商品編集
    </div>

    <div class="edit-wrapper">
      <div class="left">
        <div style="font-size:12px; color:#666; margin-bottom:6px;">アクセス履歴: <a href="{{ route('products.index') }}">商品一覧</a> / 商品編集</div>
        <img id="edit-preview" src="{{ $product->image_path ? asset('storage/'.$product->image_path) : '' }}" alt="" style="width:100%; max-width:420px; display:block; margin-bottom:8px;">
        <div>
          <input id="edit-image" type="file" name="image" accept=".png,.jpeg">
          <div id="edit-filename" style="margin-top:6px;"></div>
        </div>
      </div>

      <div class="right">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="form-container">
          @csrf
          @method('PUT')

          <div class="form-row">
            <label>商品名</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
            @error('name') <div class="error-text">{{ $message }}</div> @enderror
          </div>

          <div class="form-row">
            <label>値段</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
            @error('price') <div class="error-text">{{ $message }}</div> @enderror
          </div>

          <div class="form-row">
            <label>季節</label>
            <div>
              @php $selected = old('seasons', $product->seasons ?? []) @endphp
              @foreach(['春','夏','秋','冬'] as $s)
                <label style="margin-right:8px;"><input type="checkbox" name="seasons[]" value="{{ $s }}" {{ in_array($s, $selected) ? 'checked':'' }}> {{ $s }}</label>
              @endforeach
            </div>
            @error('seasons') <div class="error-text">{{ $message }}</div> @enderror
          </div>

          <div class="form-row">
            <label>商品説明</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
            @error('description') <div class="error-text">{{ $message }}</div> @enderror
          </div>

          <div class="form-actions">
            <button type="button" class="btn btn-back" onclick="history.back()">戻る</button>
            <button type="submit" class="btn btn-submit">変更を保存</button>
          </div>
        </form>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="margin-top:10px; text-align:right;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-delete">削除</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function(){
      setupImagePreview('#edit-image','#edit-preview','#edit-filename');
    });
  </script>
@endsection

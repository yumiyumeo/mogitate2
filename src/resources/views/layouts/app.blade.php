<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/products.css') }}">
</head>
<body>
  @include('partials.header')

  <div class="site-layout">
    <aside class="sidebar-column">
      {{-- サイドバーはページ共通だが表示位置は各ビューで制御します --}}
      @yield('sidebar')
    </aside>

    <main class="main-column">
      @yield('content')
    </main>
  </div>

  {{-- 画像プレビュー + ファイル名表示 --}}
  <script>
    function setupImagePreview(inputSelector, previewSelector, filenameSelector){
      const input = document.querySelector(inputSelector);
      const preview = document.querySelector(previewSelector);
      const fname = document.querySelector(filenameSelector);
      if(!input) return;
      input.addEventListener('change', function(){
        const file = this.files && this.files[0];
        if(file){
          fname && (fname.textContent = file.name);
          const reader = new FileReader();
          reader.onload = e => { if(preview) preview.src = e.target.result; };
          reader.readAsDataURL(file);
        } else {
          fname && (fname.textContent = '');
          if(preview) preview.src = '';
        }
      });
    }
    document.addEventListener('DOMContentLoaded', function(){ /* views will call their setups */ });
  </script>
</body>
</html>

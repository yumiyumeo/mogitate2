<div class="sidebar">
  <form action="{{ route('products.search') }}" method="GET">
    <div class="sidebar-field">
      <label>検索</label>
      <input type="text" name="keyword" value="{{ request('keyword') ?? ($keyword ?? '') }}" placeholder="検索キーワード">
    </div>

    <div class="sidebar-field">
      <button type="submit" class="btn-search">検索</button>
    </div>

    <div class="sidebar-field">
      <label>価格順で表示</label>
      <select name="order">
        <option value="">指定なし</option>
        <option value="price_asc" {{ request('order')=='price_asc' ? 'selected' : '' }}>価格が安い順</option>
        <option value="price_desc" {{ request('order')=='price_desc' ? 'selected' : '' }}>価格が高い順</option>
      </select>
    </div>

    <div class="sidebar-field">
      <label>価格で絞り込み</label>
      <select name="price_filter">
        <option value="">指定なし</option>
        <option value="0-1000" {{ request('price_filter')=='0-1000' ? 'selected' : '' }}>0〜1,000円</option>
        <option value="1001-5000" {{ request('price_filter')=='1001-5000' ? 'selected' : '' }}>1,001〜5,000円</option>
        <option value="5001-10000" {{ request('price_filter')=='5001-10000' ? 'selected' : '' }}>5,001〜10,000円</option>
      </select>
    </div>
  </form>
</div>

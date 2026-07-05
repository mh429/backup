<x-layout>
  <header style="width: 800px; height:100px; background-color: #FBE4D5">
    <h1>商品一覧</h1>
    @auth
      <div>
        <a href="{{ route('product.create', ['from' => 'index']) }}">新規商品登録</a>        
      </div>
    @endauth
  </header>

  <div>
    <form action="" method="get">
      @csrf
      <p>カテゴリ</p>
      <div>
        <select id="category" name="product_category_id" required>
          <option value="">選択してください</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('product_category_id', $product['product_category_id'] ?? '') == $category->id)>
              {{ $category->name }}
            </option>
          @endforeach  
        </select>  
        {{-- サブカテゴリの中身はJS側でAjax取得して作る。
             data-selected には「以前選択していたID」を入れておき、取得後にJSでそのIDのoptionにselectedを付ける --}}
        <select id="subcategory" name="product_subcategory_id" required data-selected="{{ old('product_subcategory_id', $product['product_subcategory_id'] ?? '') }}" style="display:none;">
        </select>
      </div>    
      <label>
        <p>フリーワード</p>
        <input type="text">
      </label>
      <input type="submit" value="商品検索">
    </form>
  </div>

  @foreach ($products as $product)
    <div>
      <hr>
      <div>
        @php
          $image = null;
          foreach (['image_1', 'image_2', 'image_3', 'image_4'] as $column) {
              if (!empty($product->$column)) {
                  $image = $product->$column;
                  break;
              }
          }
        @endphp
        @if ($image)
          <img src="{{ asset('storage/' . $image) }}" style="width: 200px">
        @endif
      </div>
      <div>
        <p>{{ $product->category->name }}>{{ $product->subcategory->name }}</p>
        <p><a href="{{ route('product.show', $product) }}">{{ $product->name }}</a></p>
        <p><a href="{{ route('product.show', $product) }}">詳細</a></p>
      </div>
    </div>
  @endforeach

  <a href="/">トップに戻る</a>
</x-layout>
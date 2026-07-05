<x-layout>
  <header style="width: 800px; height:100px; background-color: #FBE4D5">
    <h1>商品詳細</h1>
    <div>
      <a href="/">トップに戻る</a>        
    </div>
  </header>

  <div>
    <div>
      <p>{{ $product->category->name }}>{{ $product->subcategory->name }}</p>
    </div>
    <div>
      <h2>{{ $product->name }}</h2>
      <p>更新日時：{{ $product->updated_at->format('Ymd') }}</p>
    </div>
    <div>
      @foreach (['image_1', 'image_2', 'image_3', 'image_4'] as $column)
        @if (!empty($product->$column))
          <img src="{{ asset('storage/' . $product->$column) }}" style="width: 200px">
        @endif
      @endforeach
    </div>
    <div>
      <p>◾商品説明</p>
      <p>{{ $product->product_content }}</p>
    </div>
  </div>

  <a href="{{ session('product_index_url', route('product.index')) }}">商品一覧に戻る</a>
</x-layout>
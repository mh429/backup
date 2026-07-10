<x-admin_layout>
  <header style="width: 800px; height:100px; background-color: #D0CECE">
    <h1>商品一覧</h1>

    <div>
      <a href="{{ route('admin.index') }}">トップへ戻る</a>  
    </div>
  </header>

  <a href="{{ route('admin.product.create') }}">新規登録</a>

  <div>
    <form action="" method="get">
      <table>
        <tr>
          <th>ID</th>
          <td>
            <input type="text" name="product_id" value="{{ $product_search['product_id'] ?? '' }}">
          </td>
        </tr>
        <tr>
          <th>フリーワード</th>
          <td>
            <input type="text" name="freeword" value="{{ $product_search['freeword'] ?? '' }}">
          </td>
        </tr>      
      </table>      
      <input type="submit" value="検索する">
    </form>
  </div>

  <hr>

  <table>
    <thead>
      <th>
        <a href="{{ route('admin.product.index', array_merge(request()->query(), [
            'sort' => 'id',
            'order' => request('sort') === 'id' && request('order') === 'asc'
                ? 'desc'
                : 'asc',
        ])) }}">
            ID
            @if(request('sort', 'id') === 'id')
                {{ request('order', 'desc') === 'asc' ? '▲' : '▼' }}
            @endif
        </a>
      </th>
      <th>商品名</th>
      <th>
        <a href="{{ route('admin.product.index', array_merge(request()->query(), [
            'sort' => 'created_at',
            'order' => request('sort') === 'created_at' && request('order') === 'asc'
                ? 'desc'
                : 'asc',
        ])) }}">
            登録日時
            @if(request('sort') === 'created_at')
                {{ request('order') === 'asc' ? '▲' : '▼' }}
            @endif
        </a>        
      </th>
      <th>編集</th>
      <th>詳細</th>
    </thead>
    <tbody>
      @foreach ($products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->created_at->format('Y/n/j') }}</td>
        <td><a href="{{ route('admin.product.edit', $product->id) }}">編集</a></td>
        <td><a href="{{ route('admin.product.show', $product->id) }}">詳細</a></td>        
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $products->links() }}

  
</x-admin_layout>
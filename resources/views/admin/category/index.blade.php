<x-admin_layout>
  <header style="width: 800px; height:100px; background-color: #D0CECE">
    <h1>商品カテゴリ一覧</h1>

    <div>
      <a href="{{ route('admin.index') }}">トップへ戻る</a>  
    </div>
  </header>

  <a href="{{ route('admin.category.create') }}">新規登録</a>

  <div>
    <form action="" method="get">
      <table>
        <tr>
          <th>ID</th>
          <td>
            <input type="text" name="category_id" value="{{ $category_search['category_id'] ?? '' }}">
          </td>
        </tr>
        <tr>
          <th>フリーワード</th>
          <td>
            <input type="text" name="freeword" value="{{ $category_search['freeword'] ?? '' }}">
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
        <a href="{{ route('admin.category.index', array_merge(request()->query(), [
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
      <th>商品大カテゴリ</th>
      <th>
        <a href="{{ route('admin.category.index', array_merge(request()->query(), [
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
      @foreach ($categories as $category)
      <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->created_at->format('Y/n/j') }}</td>
        <td><a href="{{ route('admin.category.edit', $category->id) }}">編集</a></td>
        <td><a href="{{ route('admin.category.show', $category->id) }}">詳細</a></td>        
      </tr>

      @endforeach
    </tbody>
  </table>

  {{ $categories->links() }}

  
</x-admin_layout>
<x-admin_layout>
  <header style="width: 800px; height:100px; background-color: #D0CECE">
    <h1>会員一覧</h1>

    <div>
      <a href="{{ route('admin.index') }}">トップへ戻る</a>  
    </div>
  </header>

  <a href="{{ route('admin.member.create') }}">新規登録</a>

  <div>
    <form action="" method="get">
      <table>
        <tr>
          <th>ID</th>
          <td>
            <input type="text" name="member_id" value="{{ $member_search['member_id'] ?? '' }}">
          </td>
        </tr>
          <th>性別</th>
          <td>
            @foreach (config('master.gender') as $key => $value)
              <label>
                <input type="checkbox" name="gender[]" value="{{ $key }}"  @checked(in_array($key, $member_search['gender'] ?? []))>
                  {{ $value }}
              </label>
            @endforeach            
          </td>
        </tr>
        </tr>
          <th>フリーワード</th>
          <td>
            <input type="text" name="freeword" value="{{ $member_search['freeword'] ?? '' }}">
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
        <a href="{{ route('admin.member.index', array_merge(request()->query(), [
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
      <th>氏名</th>
      <th>性別</th>
      <th>メールアドレス</th>
      <th>
        <a href="{{ route('admin.member.index', array_merge(request()->query(), [
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
      @foreach ($members as $member)
      <tr>
        <td>{{ $member->id }}</td>
        <td>{{ $member->name_sei }}　{{ $member->name_mei }}</td>
        <td>{{ config('master.gender')[$member->gender] }}</td>
        <td>{{ $member->email }}</td>
        <td>{{ $member->created_at->format('Y/n/j') }}</td>
        <td><a href="{{ route('admin.member.edit', $member->id) }}">編集</a></td>
        <td><a href="{{ route('admin.member.show', $member->id) }}">詳細</a></td>        
      </tr>

      @endforeach
    </tbody>
  </table>

  {{ $members->links() }}

  
</x-admin_layout>
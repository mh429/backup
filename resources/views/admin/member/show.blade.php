<x-admin_layout>
  <header style="width: 800px; height:100px; background-color: #D0CECE">
    <h1>会員詳細</h1>

    <div>
      <a href="{{ session('admin_member_index_url', route('admin.member.index')) }}">一覧へ戻る</a>  
    </div>
  </header>

  <table>
    <tr>
      <th>ID</th>
      <td>{{ $user->id }}</td>
    </tr>
    <tr>
      <th>氏名</th>
      <td>{{ $user->name_sei }}　{{ $user->name_mei }}</td>      
    </tr>
    <tr>
      <th>ニックネーム</th>
      <td>{{ $user->nickname }}</td>
    </tr>
    <tr>
      <th>性別</th>
      <td>{{ config('master.gender')[$user->gender] }}</td>      
    </tr>
    <tr>
      <th>パスワード</th>
      <td>セキュリティのため非表示</td>
    </tr>
    <tr>
      <th>メールアドレス</th>
      <td>{{ $user->email }}</td>
    </tr>
  </table>

  <a href="{{ route('admin.member.edit', $user->id) }}">編集</a>

  <form action="{{ route('admin.member.destroy', $user->id) }}" method="post">
    @csrf
    @method('delete')
    <input type="submit" value="削除">
  </form>

</x-admin_layout>
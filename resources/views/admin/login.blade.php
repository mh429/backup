
<x-admin_layout>
  <header style="width: 800px; height:100px; background-color: #D0CECE">
  </header>

  <h1>管理画面</h1>

  <form action="{{ route('admin.login') }}" method="post">
    @csrf
    <div>
      <label>
        <p>ログインID</p>
        <input type="text" name="login_id" value="{{ old('login_id') }}">
      </label>
    </div>
    <div>
      <label>
        <p>パスワード</p>
        <input type="text" name="password">        
      </label>
    </div>

    <div>
      @if($errors->any())
        <p style="color: red">※{{ $errors->first() }}</p>
      @endif      
    </div>

    <input type="submit" value="ログイン">

  </form>

  <footer style="width: 800px; height:100px; background-color: #D0CECE">
  </footer>

</x-admin_layout>
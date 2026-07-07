<x-admin_layout>
  <header style="width: 800px; height:100px; background-color: #D0CECE">
    <h1>管理画面メインメニュー</h1>

    <div>
      <p>ようこそ {{ auth()->guard('admin')->user()->name }} さん</p>        
      <form action="{{ route('admin.logout') }}" method="post">
        @csrf
        <input type="submit" value="ログアウト"> 
      </form>      
    </div>
  </header>

  <p>管理者TOP画面</p>
</x-admin_layout>
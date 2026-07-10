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

  <a href="{{ route('admin.member.index') }}">会員一覧</a>
  <a href="{{ route('admin.category.index') }}">商品カテゴリ一覧</a>
  <a href="{{ route('admin.product.index') }}">商品一覧</a>


  
</x-admin_layout>
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="container">

    <div class="container-title">
        <h1 class="title">商品一覧</h1>
        <a href="{{ route('products.create') }}" class="create-btn">＋ 商品を追加</a>
    </div>

    <div class="main-content">

        <!-- 左：検索フォーム -->
        <form action="{{ route('products.index') }}" method="GET" class="search-form">
            <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
            <button type="submit">検索</button>

            <p class="sort-label">価格順で表示</p>
            <select name="sort">
                <option value="">並び替え</option>
                <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>価格が高い順</option>
                <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>価格が安い順</option>
            </select>
            <div class="form-divider"></div>
        </form>

        <!-- 右：カード -->
        <div class="card-area">
            <div class="card-grid">
                @foreach($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h2>{{ $product->name }}</h2>
                        <p>¥{{ number_format($product->price) }}</p>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- ページネーション -->
            <div class="pagination">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>


</div>
@endsection
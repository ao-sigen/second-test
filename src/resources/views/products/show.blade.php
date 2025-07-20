@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="title">商品詳細・編集</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- 上段：画像 + 情報 --}}
        <div class="top-section">
            <div class="left-image">
                @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="product-image">
                @endif
                <div class="image-upload">
                    <input type="file" name="image" id="image" accept="image/*">
                    @error('image')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="right-info">
                <div class="form-group">
                    <label>商品名</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}">
                    @error('name')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>値段</label>
                    <input type="text" name="price" value="{{ old('price', $product->price) }}">
                    @error('price')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>季節（複数選択可）</label>
                    <div class="season-radio-style">
                        @foreach($seasons as $season)
                        <input type="checkbox" name="season[]" value="{{ $season->id }}" id="season-{{ $season->id }}" {{ in_array($season->id, old('season', $productSeasons)) ? 'checked' : '' }} hidden>
                        <label for="season-{{ $season->id }}" class="radio-label">
                            <span class="circle"></span>{{ $season->name }}
                        </label>
                        @endforeach
                    </div>
                    @error('season')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- 商品説明 --}}
        <div class="form-group description-group">
            <label>商品説明</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
            @error('description')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- ボタンエリア --}}
        <div class="button-area">
            <div class="left-buttons">
                <a href="{{ route('products.index') }}" class="back-btn">戻る</a>
                <button type="submit" class="save-btn">変更を保存</button>
            </div>
    </form>
    <form class="delete-form" action="{{ route('products.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $product->id }}">
        <button typ="submit" class="delete-btn">🗑️</button>
    </form>
</div>
</form>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="create-container">
    <h1 class="title">商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div class="form-group">
            <label for="name">商品名<span class="required">必須</span></label></label>
            <input type="text" id="name" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- 値段 -->
        <div class="form-group">
            <label for="price">値段<span class="required">必須</span></label></label>
            <input type="text" id="price" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- 商品画像 -->
        <div class="form-group">
            <label for="image">商品画像<span class="required">必須</span></label></label>
            <input type="file" id="image" name="image" accept=".jpeg,.jpg,.png">
            @error('image')
            <p class="error">{{ $message }}</p>
            @enderror
            <div class="preview">
                <img id="preview-image" src="#" alt="選択した画像が表示されます" style="display: none; max-width: 300px;">
            </div>
        </div>

        <!-- 季節 -->
        <div class="form-group">
            <label>季節（複数選択可）<span class="required">必須</span></label></label>
            <div class="season-radio-style">
                @foreach($seasons as $season)
                <input type="checkbox" name="season[]" value="{{ $season->id }}" id="season-{{ $season->id }}" {{ in_array($season->id, old('season', [])) ? 'checked' : '' }} hidden>
                <label for="season-{{ $season->id }}" class="radio-label">
                    <span class="circle"></span>{{ $season->name }}
                </label>
                @endforeach
            </div>
            @error('season')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- 商品説明 -->
        <div class="form-group">
            <label for="description">商品説明<span class="required">必須</span></label></label>
            <textarea id="description" name="description" placeholder="商品の説明を入力" rows="5">{{ old('description') }}</textarea>
            @error('description')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>



        <!-- ボタン -->
        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn btn-back">戻る</a>
            <button type="submit" class="btn btn-submit">登録</button>
        </div>
    </form>
</div>

@section('js')
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview-image');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });
</script>
@endsection

@endsection
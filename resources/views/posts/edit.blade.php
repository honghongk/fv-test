@extends('layouts.app')

@section('content')
<div class="container">
    <h1>게시글 수정</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 1rem;">
            <label for="title">제목</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required maxlength="45">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="contents">내용</label>
            <textarea id="contents" name="contents" rows="10" required>{{ old('contents', $post->contents) }}</textarea>
        </div>

        <div style="margin-bottom: 1rem;">
            <button type="submit">수정</button>
            <a href="{{ route('posts.index') }}">취소</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>게시글 작성</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 1rem;">
            <label for="title">제목</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required maxlength="45">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="contents">내용</label>
            <textarea id="contents" name="contents" rows="10" required>{{ old('contents') }}</textarea>
        </div>

        <div style="margin-bottom: 1rem;">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <button type="submit">작성</button>
            <a href="{{ route('posts.list') }}">취소</a>
        </div>
    </form>
</div>
@endsection

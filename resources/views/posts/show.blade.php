@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>

    <p><strong>작성자:</strong> {{ $post->user_id }}</p>
    <p><strong>작성일:</strong> {{ $post->created_at }}</p>

    <div style="margin-top: 1rem;">
        {!! nl2br(e($post->contents)) !!}
    </div>

    <div style="margin-top: 1rem;">
        <a href="{{ route('posts.index') }}">목록으로</a>
        @if ($post->user_id === Auth::id())
            <a href="{{ route('posts.edit', $post->id) }}">수정</a>
        @endif
    </div>
</div>
@endsection

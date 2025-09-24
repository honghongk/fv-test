@extends('layouts.app')

@section('content')
<div class="container">
    <h1>댓글 수정</h1>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="contents">댓글 내용</label>
            <textarea id="contents" name="contents" rows="5" required>{{ old('contents', $comment->contents) }}</textarea>
        </div>

        <div style="margin-top: 1rem;">
            <button type="submit">수정 완료</button>
            <a href="{{ route('posts.show', $comment->post_id) }}" style="margin-left: 1rem;">취소</a>
        </div>
    </form>
</div>
@endsection

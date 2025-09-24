@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>

    <p><strong>작성자:</strong> {{ $post->user->name }}</p>
    <p><strong>작성일:</strong> {{ $post->created_at }}</p>

    <div style="margin-top: 1rem;">
        {!! nl2br(e($post->contents)) !!}
    </div>

    <div style="margin-top: 1rem;">
        <a href="{{ route('posts.list') }}">목록으로</a>
        @if ($post->user_id === Auth::id())
            <a href="{{ route('posts.edit', $post->id) }}">수정</a>
        @endif
    </div>

    {{-- 댓글 섹션 --}}
    <div style="margin-top: 2rem;">
        <h2>댓글</h2>

        {{-- 댓글 리스트 --}}
        @forelse ($post->comments as $comment)
            <div style="border-top: 1px solid #ddd; padding: 0.5rem 0;">
                <div>
                    <strong>{{ $comment->user->name }}</strong>
                    ({{ $comment->created_at }}):

                    <div style="display: inline-flex;">
                        {{-- 댓글 작성자만 수정/삭제 버튼 표시 --}}
                        @if ($comment->user_id === Auth::id())
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline; padding:1em; margin:0;">
                                <a href="{{ route('comments.edit', $comment->id) }}" style="margin-left: 1rem; font-size: 0.9rem; padding: 1em;">
                                    수정
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="font-size: 0.9rem; margin-left: 0.5rem; background:none; color:red; border:none; cursor:pointer;">삭제</button>
                            </form>
                        @endif
                    </div>
                    
                </div>
                <p>{!! nl2br(e($comment->contents)) !!}</p>
            </div>
        @empty
            <p>댓글이 없습니다.</p>
        @endforelse

        {{-- 댓글 작성 폼 --}}
        @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST" style="margin-top: 1rem;">
            @csrf
            <div>
                <textarea name="contents" rows="3" placeholder="댓글을 작성하세요." required></textarea>
            </div>
            <div>
                <button type="submit">댓글 작성</button>
            </div>
        </form>
        @else
        <p>댓글을 작성하려면 <a href="{{ route('login') }}">로그인</a>이 필요합니다.</p>
        @endauth
    </div>
</div>

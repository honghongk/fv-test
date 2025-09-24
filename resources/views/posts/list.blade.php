@extends('layouts.app')

@section('content')
<div class="container">
    <h1>게시글 목록</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('posts.create') }}">새 글 작성</a>

    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 1rem; width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
                <th>액션</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}">
                            {{ $post->title }}
                        </a>
                    </td>
                    <td>{{ $post->user_id }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        @if ($post->user_id === Auth::id())
                            <a href="{{ route('posts.edit', $post->id) }}">수정</a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('정말 삭제하시겠습니까?')">
                                    삭제
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 1rem;">
        {{ $posts->links() }}
    </div>
</div>
@endsection

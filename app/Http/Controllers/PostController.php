<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * 게시글 목록 조회 (페이지네이션)
     */
    public function list()
    {
        $posts = Post::latest()->paginate(10);

        return view('posts.list', compact('posts'));
    }


    /**
     * 게시글 상세 조회
     */
    public function show(int $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }


    /**
     * 게시글 작성 폼
     */
    public function create()
    {
        return view('posts.create');
    }


    /**
     * 게시글 저장
     */
    public function store(Request $request)
    {
        // 유효성 검사
        $data = $request->validate([
            'title'    => 'required|string|max:45',
            'contents' => 'required|string',
        ]);
        $data['user_id'] = Auth::id();

        // 게시글 생성
        Post::create($data);

        return redirect()
            ->route('posts.list')
            ->with('success', '게시글이 생성되었습니다.');
    }


    /**
     * 게시글 수정 폼
     */
    public function edit(int $id)
    {
        $post = Post::findOrFail($id);

        // 본인만 수정
        if ( $post->user_id !== Auth::id() )
            abort(403, '권한이 없습니다.');

        return view('posts.edit', compact('post'));
    }


    /**
     * 게시글 업데이트
     */
    public function update(Request $request, int $id)
    {
        $post = Post::findOrFail($id);

        // 본인만 수정
        if ( $post->user_id !== Auth::id() )
            abort(403, '권한이 없습니다.');

        // 유효성 검사
        $data = $request->validate([
            'title'    => 'required|string|max:45',
            'contents' => 'required|string',
        ]);

        // 게시글 업데이트
        $post->update($data);

        return redirect()
            ->route('posts.list')
            ->with('success', '게시글이 수정되었습니다.');
    }


    /**
     * 게시글 삭제 (SoftDeletes)
     */
    public function destroy(int $id)
    {
        $post = Post::findOrFail($id);

        // 본인만 삭제
        if ( $post->user_id !== Auth::id() )
            abort(403, '권한이 없습니다.');

        // SoftDelete 적용
        $post->delete();

        return redirect()
            ->route('posts.list')
            ->with('success', '게시글이 삭제되었습니다.');
    }
}

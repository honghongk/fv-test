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
    public function list(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'data' => $posts
            ]);
        }

        return view('posts.list', compact('posts'));
    }

    /**
     * 게시글 상세 조회
     */
    public function show(Request $request, int $id)
    {
        $post = Post::findOrFail($id);
        $post->load('comments');

        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'data' => $post
            ]);
        }

        return view('posts.show', compact('post'));
    }

    /**
     * 게시글 작성 폼
     */
    public function create(Request $request)
    {
        return view('posts.create');
    }

    /**
     * 게시글 저장
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => 'required|string|max:45',
            'contents' => 'required|string',
        ]);
        $data['user_id'] = Auth::id();

        $post = Post::create($data);

        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'message' => '게시글이 생성되었습니다.',
                'data' => $post
            ], 201);
        }

        return redirect()
            ->route('posts.list')
            ->with('success', '게시글이 생성되었습니다.');
    }

    /**
     * 게시글 수정 폼
     */
    public function edit(Request $request, int $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id())
        {
            if ($request->wantsJson()) {
                return response()->json(['success'=>false, 'message'=>'권한이 없습니다.'], 403);
            }
            abort(403, '권한이 없습니다.');
        }

        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'data' => $post
            ]);
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * 게시글 업데이트
     */
    public function update(Request $request, int $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id())
        {
            if ($request->wantsJson()) {
                return response()->json(['success'=>false, 'message'=>'권한이 없습니다.'], 403);
            }
            abort(403, '권한이 없습니다.');
        }

        $data = $request->validate([
            'title'    => 'required|string|max:45',
            'contents' => 'required|string',
        ]);

        $post->update($data);

        if ($request->wantsJson())
        {
            return response()->json([
                'success'=>true,
                'message'=>'게시글이 수정되었습니다.',
                'data'=>$post
            ]);
        }

        return redirect()
            ->route('posts.list')
            ->with('success', '게시글이 수정되었습니다.');
    }

    /**
     * 게시글 삭제 (SoftDeletes)
     */
    public function destroy(Request $request, int $id)
    {
        $post = Post::find($id);

        // 이미 지워진 게시글 포함
        if ($post?->user_id !== Auth::id())
        {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => '권한이 없습니다.'
                ], 403);
            }
            abort(403, '권한이 없습니다.');
        }

        $post->delete();

        if ($request->wantsJson())
        {
            return response()->json([
                'success'=>true,
                'message'=>'게시글이 삭제되었습니다.'
            ]);
        }

        return redirect()
            ->route('posts.list')
            ->with('success', '게시글이 삭제되었습니다.');
    }
}

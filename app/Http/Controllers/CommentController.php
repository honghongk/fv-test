<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * 댓글 저장
     */
    public function store(Request $request, int $postId)
    {
        $post = Post::findOrFail($postId);

        $user = Auth::user();
        if (! $user)
        {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => '로그인이 필요합니다.'
                ],403);
            }
            abort(403, '로그인이 필요합니다.');
        }

        $data = $request->validate([
            'contents' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->post_id  = $post->id;
        $comment->user_id  = $user->id;
        $comment->contents = $data['contents'];
        $comment->save();

        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'message' => '댓글이 작성되었습니다.',
                'data'    => $comment
            ], 201);
        }

        return redirect()
            ->route('posts.show', $post->id)
            ->with('success', '댓글이 작성되었습니다.');
    }

    /**
     * 댓글 수정 폼
     */
    public function edit(Request $request, int $id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }

    /**
     * 댓글 업데이트
     */
    public function update(Request $request, int $id)
    {
        $comment = Comment::findOrFail($id);

        // 이미 삭제되었거나 작성자가 아니면
        if ($comment?->user_id !== Auth::id())
        {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => '권한이 없습니다.'
                ],403);
            }
            abort(403, '권한이 없습니다.');
        }

        $data = $request->validate([
            'contents' => 'required|string',
        ]);

        $comment->update($data);

        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'message' => '댓글이 수정되었습니다.',
                'data' => $comment
            ]);
        }

        return redirect()
            ->route('posts.show', $comment->post_id)
            ->with('success', '댓글이 수정되었습니다.');
    }

    /**
     * 댓글 삭제
     */
    public function destroy(Request $request, int $id)
    {
        $comment = Comment::findOrFail($id);

        // 이미 삭제되었거나 작성자가 아니면
        if ($comment?->user_id !== Auth::id())
        {
            if ($request->wantsJson()) {
                return response()->json(['success'=>false,'message'=>'권한이 없습니다.'],403);
            }
            abort(403, '권한이 없습니다.');
        }

        $comment->delete();

        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'message' => '댓글이 삭제되었습니다.'
            ]);
        }

        return redirect()
            ->route('posts.show', $comment->post_id)
            ->with('success', '댓글이 삭제되었습니다.');
    }
}

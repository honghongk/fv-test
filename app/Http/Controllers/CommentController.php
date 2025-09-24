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

        // 로그인 사용자만 작성 가능
        $user = Auth::user();
        if ( ! $user )
            abort(403, '로그인이 필요합니다.');

        // 유효성 검사
        $data = $request->validate([
            'contents' => 'required|string',
        ]);

        // 댓글 생성
        $comment = new Comment();
        $comment->post_id  = $post->id;
        $comment->user_id  = $user->id;
        $comment->contents = $data['contents'];
        $comment->save();

        return redirect()
            ->route('posts.show', $post->id)
            ->with('success', '댓글이 작성되었습니다.');
    }

    /**
     * 댓글 수정 폼
     */
    public function edit(int $id)
    {
        $comment = Comment::findOrFail($id);

        // 본인만 수정 가능
        if ($comment->user_id !== Auth::id())
            abort(403, '권한이 없습니다.');

        return view('comments.edit', compact('comment'));
    }

    /**
     * 댓글 업데이트
     */
    public function update(Request $request, int $id)
    {
        $comment = Comment::findOrFail($id);

        // 본인만 수정 가능
        if ($comment->user_id !== Auth::id())
            abort(403, '권한이 없습니다.');

        // 유효성 검사
        $data = $request->validate([
            'contents' => 'required|string',
        ]);

        $comment->update($data);

        return redirect()
            ->route('posts.show', $comment->post_id)
            ->with('success', '댓글이 수정되었습니다.');
    }

    /**
     * 댓글 삭제
     */
    public function destroy(int $id)
    {
        $comment = Comment::findOrFail($id);

        // 본인만 삭제 가능
        if ($comment->user_id !== Auth::id()) {
            abort(403, '권한이 없습니다.');
        }

        $comment->delete();

        return redirect()
            ->route('posts.show', $comment->post_id)
            ->with('success', '댓글이 삭제되었습니다.');
    }
}

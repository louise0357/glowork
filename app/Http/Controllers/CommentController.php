<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'table_rows_id' => 'required|exists:table_rows,id',
            'comment' => 'required|string|max:255',
        ]);

        $comment = Comment::create([
            'table_rows_id' => $request->table_rows_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return response()->json(['success' => true]);
    }

    public function getComments($rowId)
    {
        $comments = Comment::with('user') 
            ->where('table_rows_id', $rowId)
            ->get();
    
        return response()->json([
            'comments' => $comments,
            'um' => auth()->user()->username
        ]);
    }

    public function deleteComment(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|integer|max:11',
        ]);
    
        $comment = Comment::find($request->comment_id);
    
        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Yorum bulunamadı.',
            ], 404);
        }
    
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Yorum başarıyla silindi.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bu yorumu silmeye yetkiniz yok.',
            ], 403);
        }
    }
    
    
}

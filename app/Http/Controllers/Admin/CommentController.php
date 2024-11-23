<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function store(Request $request, $taskId)
    {
        // Validate comment input
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Find the task that the comment is associated with
        $task = Task::findOrFail($taskId);

        // Create the comment and associate it with the task and the user
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::id();
        $comment->task_id = $task->id;
        $comment->save();

        // Redirect back to the task page with a success message
        return back()->with('success', 'Comment added successfully!');
    }

    public function edit($commentId)
{
    $comment = Comment::findOrFail($commentId);
    $this->authorize('update', $comment); // Ensure the user can only edit their own comments.
    return view('admin.comments.edit', compact('comment'));
}

public function update(Request $request, $commentId)
{
    $comment = Comment::findOrFail($commentId);
    $this->authorize('update', $comment);

    $request->validate([
        'content' => 'required|string|max:255',
    ]);

    $comment->content = $request->input('content');
    $comment->save();
    return view('admin.tasks.view');
    //return redirect('/tasks.show')->with('status', 'tasks updated successfully');
}

public function destroy($commentId)
{
    $comment = Comment::findOrFail($commentId);
    $this->authorize('delete', $comment); // Ensure the user can only delete their own comments.
    $comment->delete();

    return redirect()->back()->with('success', 'Comment deleted successfully!');
}
}

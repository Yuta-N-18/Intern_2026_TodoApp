<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function showall(){
        $user_id = auth()->id();
        $page_title = "Task view";
        $task_list = Task::where('user_id', $user_id)->get();
        return view('tasks-view-all', ['title'=>$page_title, 'tasks'=>$task_list]);
    }

    public function create(){
        $page_title = "Create task";
        return view('task-create', ['title'=>$page_title]);
    }

    public function store(Request $request){
        $title = $request->input('title');
        $comment = $request->input('comment');

        $validated = $request->validate([
            'title' => 'required|max:255',
            'comment' => 'nullable|string',
        ]);
        
        auth()->user()->tasks()->create([
            'title' => $validated['title'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('task.showall')->with('success', "作成成功 タイトル: {$title} コメント: {$comment}");
    }

    public function edit($task_id){
        $page_title = "Edit task";

        $found = Task::findOrFail($task_id);
        $task_title = $found->title;
        $task_comment = $found->comment;
        return view('task-edit', ['title'=>$page_title, 'task_title'=>$task_title, 'task_comment'=>$task_comment, 'task_id'=>$task_id]);
    }

    public function update(Request $request, $task_id){
        $task_title = $request->input('title');
        $task_comment = $request->input('comment');

        $task = Task::findOrFail($task_id);
        $task->update([
            'title' => $task_title,
            'comment' => $task_comment,
        ]);

        return redirect()->route('task.showall')->with('success', "編集成功 タイトル: {$task_title} コメント: {$task_comment}");
    }

    public function destroy($task_id){
        $task = Task::findOrFail($task_id);
        $task->delete();

        return redirect()->route('task.showall')->with('success', "削除成功");
    }
}
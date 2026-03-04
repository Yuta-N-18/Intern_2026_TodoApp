<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * ユーザーが作成したタスクの全件表示
     */
    public function showall(){
        $task_list = auth()->user()->tasks()->get();

        return view('tasks-view-all', [
            'title' => 'Task view',
            'tasks' => $task_list,
        ]);
    }

    /**
     * タスクの新規作成画面の表示
     */
    public function create(){
        $page_title = "Create task";
        return view('task-create', ['title'=>$page_title]);
    }

    /**
     * 新規作成したタスクの保存処理（バリデーション含）
     */
    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'comment' => ['nullable', 'string', 'max:5000'],
        ]);
        
        auth()->user()->tasks()->create($validated);

        return redirect()->route('task.showall')->with('success', "作成成功 タイトル: {$validated['title']} コメント: {$validated['comment']}");
    }

    /**
     * タスク編集画面の表示
     */
    public function edit($task_id){
        $task = auth()->user()->tasks()->findOrFail($task_id);

        return view('task-edit', [
            'title' => 'Edit task',
            'task_title' => $task->title,
            'task_comment' => $task->comment,
            'task_id' => $task_id,
        ]);
    }

    /**
     * 編集したタスクのDBへの保存処理（バリデーション含）
     */
    public function update(Request $request, $task_id){
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'comment' => ['nullable', 'string', 'max:5000'],
        ]);
        
        $task = auth()->user()->tasks()->findOrFail($task_id);
        $task->update($validated);

        return redirect()->route('task.showall')->with('success', "編集成功 タイトル: {$validated['title']} コメント: {$validated['comment']}");
    }

    /**
     * タスク削除のDB処理
     */
    public function destroy($task_id){
        $task = auth()->user()->tasks()->findOrFail($task_id);
        $task->delete();

        return redirect()->route('task.showall')->with('success', "削除成功");
    }
}
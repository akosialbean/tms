<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskController extends Controller
{
    public function newtask(Request $request){
        $task = $request->validate([
            't_title' => ['required'],
            't_description' => ['required'],
            't_assignedto' => ['required'],
            't_assignedtoname' => ['required'],
            't_assignedby' => ['required'],
            't_status' => ['required'],
            'created_by' => ['required'],
            'created_at' => ['required'],
        ]);
    
        $assignedto = DB::table('users')
        ->select('name')
        ->where('id', '=', $task['t_assignedto'])
        ->first();
    
        $assignedby = DB::table('users')
        ->select('name')
        ->where('id', '=', Auth::user()->id)
        ->first();
    
        $task['t_status'] = "new";
        $task['created_by'] = Auth::user()->id;
        $task['created_at'] = now();
        $task['t_assignedtoname'] = $assignedto->name;
        $task['t_assignedby'] = $assignedby->name;
    
        $save = Task::insert($task);
    
        if($save){
            return redirect('/home')->with('message', 'Task created');
        }else{
            return redirect('/home')->with('message', 'Failed to create task');
        }
    }

    
}

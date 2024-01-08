<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::orderby('name', 'asc')->get();
        if(Auth::user()->role == 1){
            $task = DB::table('tasks')
            ->leftJoin('users', 'tasks.t_assignedto', '=', 'users.id')
            ->select('tasks.*')
            ->orderby('tasks.id', 'desc')
            ->paginate(6);
        }else{
            $task = DB::table('tasks')
            ->join('users', 'tasks.t_assignedto', '=', 'users.id')
            ->select('tasks.*', 'users.id')
            ->where('tasks.t_assignedto', '=', Auth::user()->id)
            ->paginate(6);
        }
        
        return view('home', ['users' => $user, 'tasks' => $task]);
    }

    public function newtask(Request $request){

        // dd($request);

        $task = $request->validate([
            't_title' => ['required'],
            't_description' => ['required'],
            't_assignedto' => ['required'],
            't_assignedtoname',
            't_assignedby',
            't_assignedbyname',
            't_status',
            'created_at',
        ]);
    
        $assignedto = DB::table('users')
        ->select('name')
        ->where('id', '=', $task['t_assignedto'])
        ->first();
    
        $assignedby = DB::table('users')
        ->select('name')
        ->where('id', '=', Auth::user()->id)
        ->first();
    
        $task['created_at'] = now();
        $task['t_status'] = 1;
        $task['t_assignedtoname'] = $assignedto->name;
        $task['t_assignedby'] = Auth::user()->id;
        $task['t_assignedbyname'] = $assignedby->name;

        // dd($task);
    
        $save = Task::insert($task);
    
        if($save){
            return redirect('/home')->with('message', 'Task created');
        }else{
            return redirect('/home')->with('message', 'Failed to create task');
        }
    }

    public function updatetask(Request $request){

        // dd($request); 

        $task = $request->validate([
            'id' => ['required'],
            't_remarks' => ['required'],
            't_status' => ['required'],
        ]);
    
        $task['updated_at'] = now();
    
        $taskToUpdate = Task::find($task['id']);
        $save = $taskToUpdate->update($task);
    
        if($save){
            return redirect('/home')->with('message', 'Task updated');
        }else{
            return redirect('/home')->with('message', 'Failed to update task');
        }
    }
    
}

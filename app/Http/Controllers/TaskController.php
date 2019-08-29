<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\Client;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function index()
    {
        $userid = Auth::id();
       //$tasks = Task::all()->where('userid', $userid);

//        $tasks = Task::where('userid', $userid)
//        ->leftJoin('clients', 'clients.id', '=', 'tasks.worktaskid')
//        ->select('clients.title');
        $tasks = DB::select('SELECT a.id,a.title,a.content,b.client FROM `tasks` AS a LEFT JOIN clients AS b ON a.worktaskid = b.id WHERE a.userid = ?', [$userid]);

        return view('tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = DB::select('SELECT * FROM workgroups as a left join clients as b on a.workid = b.id left join jobs as c on a.workid = c.id where c.complete = 0');

        return view('tasks.create')->with('clients', $clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userid = Auth::id();

        $worktaskid = $request['worktaskid'];

        $task = Task::create([
            'userid' => $userid,
            'title' => $request['title'],
            'content' => $request['content'],
            'worktaskid' => $worktaskid,

        ]);

        $task->save();

        return redirect('tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $userid = Auth::id();
        
        $task = Task::find($id);
        $clients = Client::all();

        if($userid == $task['userid']){
            return view('tasks.edit')->with('task', $task)
                                          ->with('clients', $clients);
        }else{
            return back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $task = Task::find($id);

        $task->title = $request['title'];
        $task->content = $request['content'];
        $task->worktaskid = $request['worktaskid'];

        $task->save();

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return back();
    }
}

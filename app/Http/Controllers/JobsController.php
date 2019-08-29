<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Client;
use App\Job;
use App\User;
use App\Workgroup;


class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {

        $jobs = DB::select('SELECT a.id,a.title,a.description,b.client,a.fullprice, a.complete FROM `jobs` AS a LEFT JOIN clients AS b ON a.clientid = b.id where a.complete = 0');

        return view('jobs.index')->with('jobs', $jobs);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();

        return view('jobs.create')->with('clients', $clients);
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
        $client = $request['client'];
        $title = $request['title'];
        $description = $request['description'];
        $fullprice = $request['price'];
        $teamprice = $fullprice * 0.5;
        $companypart = $fullprice * 0.5;

        $job = Job::create([
           'userid' => $userid,
           'clientid' => $client,
           'title' => $title,
           'description' => $description,
            'fullprice' => $fullprice,
            'teamprice' => $teamprice,
            'companypart' => $companypart,
            'percentage' => 50,
        ]);

        $job->save();

        return redirect('/jobs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);
        $users = User::all();
      //  $workers = Workgroup::all()->where('workid', $id);
        $workers = DB::select('SELECT a.userpercentage, c.name, a.userid FROM workgroups as a left join jobs as b on a.workid = b.id left join users as c on a.userid = c.id where a.workid = ?', [$id]);

        return view('jobs.show')->with('job', $job)
                                    ->with('users', $users)->with('workers', $workers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);
        $client = Client::all();

        return view('jobs.edit')->with('job', $job)
                ->with('clients', $client);
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
        $job = Job::find($id);

        $job->title = $request['title'];
        $job->description = $request['description'];
        $job->fullprice = $request['price'];
        $job->clientid = $request['client'];
        $job->teamprice = $request['price'] * 0.5;
        $job->companypart = $request['price'] * 0.5;

        $job->save();

        return redirect('jobs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $job = Job::find($id);

       $job->delete();

       return redirect('jobs');
    }

    public function complete($id){
        $job = Job::find($id);
        $job->complete = 1;
        $job->save();
        $workers = Workgroup::all()->where('workid', $id);
        foreach ($workers as $worker){
            $userid = $worker->userid;
           $percentage = $worker->userpercentage;
           $salary = $job->fullprice * ($percentage / 100);
           $user = User::all()->where('id', $userid)->first();
           $user->salary += $salary;
           $user->save();
        }

        return redirect('jobs');
    }
}

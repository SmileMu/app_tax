<?php

//use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Session;

use App\job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('insert.job');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $job=  Job::get();
        return view('insert.job',compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'job_name' => 'required',
        ]);

        Job::create([
            'job_name'=>$request ->job_name,

        ]);

        return redirect()->route('job.show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $job=DB::table('jobs')->get();
        return View::make('show.job')->with(array('jobs'=>$job));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::findOrFail($id);

        return view('edit.job',compact('job'));
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

        $data = $request->except('_method','_token','submit');

        $job = Job::findOrFail($id);

        if($job->update($data)){

           Session::flash('message', 'Update successfully!');
           Session::flash('alert-class', 'alert-success');
        }
           return redirect()->route('job.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Job::destroy($id);
        Session::flash('message', 'Delete successfully!');
        Session::flash('alert-class', 'alert-success');


        return redirect()->route('job.show');
    }
}

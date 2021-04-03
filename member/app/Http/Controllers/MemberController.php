<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = DB::table('school_members')
            ->join('schools','school_members.school_id','schools.id')
            ->select('school_members.*','schools.school_name')
            ->get();
        $schools = DB::table('schools')->get();

        return view('welcome',compact('members','schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $schools = DB::table('schools')->get();
       return view('create',compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'school' => 'required',
           ]);
        $data = array();
        $data['name']=$request->name;
        $data['email']= $request->email;
        $data['address']= $request->address;
        $data['school_id']= $request->school;
         DB::table('school_members')->insert($data);
         $members = DB::table('school_members')
            ->join('schools','school_members.school_id','schools.id')
            ->select('school_members.*','schools.school_name')
            ->get();
        $schools = DB::table('schools')->get();
        $notification=array(
            'messege'=>'Member Successfully Add',
            'alert-type'=>'success'
             );
             return Redirect()->route('welcome')->with($notification);

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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getSchoolMember($school_id){
        if($school_id==0){
            $return= DB::table('school_members')
            ->join('schools','school_members.school_id','schools.id')
            ->select('school_members.*','schools.school_name')
            ->get();
        }else{
            $return = DB::table('schools')
            ->join('school_members','schools.id','school_members.school_id')
            ->select('schools.school_name','school_members.*')
            ->where('schools.id',$school_id)
            ->get();
        }



        return json_encode($return);
    }
}

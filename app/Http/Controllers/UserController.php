<?php

namespace App\Http\Controllers;
use App\Institution;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use View;
use App\User;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  User::all();
        return view('users.show_users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.add_user',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $validatedData = $request->validate([
//
//            'emp_name' =>  'required|min:3',
//
//            'inst_name' => 'required',
//            'appation_date' => 'required',
//            'age' => 'required',
//            'primary_sal' => 'required',
//            'tax_value' => 'required',
//            'email' => 'required',
//            'password' => 'required',
//        ]);
        //  return $request;
        try {
            DB::beginTransaction();
            $input = $request->all();

            $input['password'] = Hash::make($input['password']);

            User::create([
                'name'=>$request ->name,
                'role_id'=>$request -> role_id,
                'Status'=>$request -> Status,
                 'email'=>$request ->email,
                'password' =>$request -> password,

            ]);
            DB::commit();
//return 'ok';
            return redirect()->route('users')->with('success','تم اضافة  المستخدم بنجاح');

        } catch (\Exception $ex) {
            DB::rollBack();
//            return $ex;
//            return $ex;

            return redirect()->route('users')
                ->with('error','حدث خطا ما الرجاء المحاوله لاحقا');


        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $employees=DB::table('employees')->get();
        return View::make('employee.show')->with(array('employees'=>$employees));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        $roles = Role::all();

        return view('users.edit',compact('users', 'roles'));



    }


    public function edit_profile($id)
    {
        $users = User::findOrFail($id);
        //$roles = Role::all();

        return view('users.edit_profile',compact('users'));



    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return $request;
        try {
            DB::beginTransaction();
            // $type = $request->id;
            User::find($request->id)->update([
                'name'=>$request ->name,
                'role_id'=>$request -> role_id,
                'Status'=>$request -> Status,
                'email'=>$request ->email,
                'password' =>$request -> password,


            ]);

            DB::commit();

            return redirect()->route('users')
                ->with('success', 'تم تعديل بيانات المستخدمين بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();

            return redirect()->route('users')
                ->with('success', 'لم يتم تعديل بيانات المستخدمين حدث خطا');


        }
    }



 public function update_profile(Request $request)
    {
        //return $request;
        try {
            DB::beginTransaction();
            // $type = $request->id;
            User::find($request->id)->update([
                'name'=>$request ->name,
              //  'role_id'=>$request -> role_id,
                'Status'=>$request -> Status,
                'email'=>$request ->email,
                'password' =>$request -> password,


            ]);

            DB::commit();

            return redirect()->route('home')
                ->with('success', 'تم تعديل بيانات المستخدمين بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();

            return redirect()->route('home')
                ->with('success', 'لم يتم تعديل بيانات المستخدمين حدث خطا');


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id){
        try {
            //validation
            //update database
            $user = User::find($id);
            if (!$user)

                Session::flash('message', 'Delete not successfully!');
            Session::flash('alert-class', 'alert-danger');


            $user->delete();

            Session::flash('message', 'Delete successfully!');
            Session::flash('alert-class', 'alert-success');

            return redirect()->route('users')
                ->with('success','تم حذف المستخدم بنجاح');


        } catch (\Exception $ex) {
            return redirect()->route('users')->with(['error' => 'حدث خطا ما الرجاء المحاولة لاحقا']);
        }

    }

}

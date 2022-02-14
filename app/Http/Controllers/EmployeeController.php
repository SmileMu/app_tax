<?php

namespace App\Http\Controllers;
use App\Institution;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use View;
use App\Employee;
use Hash;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee=  Employee::all();
        return view('employee.show', compact('employee'));
    }



 public function employees_report()
    {
        $employee=  Employee::where("age",">",30)->get();
        return view('reports.show_report', compact('employee'));
    }

    public function employees_report_inst()
    {
        $employee=  Employee::where("institution_id","=",9)->get();
        return view('reports.show_emp_inst', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institution = Institution::all();
        return view('employee.add',compact('institution'));
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

            'emp_name' =>  'required|min:3',

            'inst_name' => 'required',
             'appation_date' => 'required',
             'age' => 'required',
            'primary_sal' => 'required',
            'tax_value' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        //  return $request;
        try {
            DB::beginTransaction();
            $input = $request->all();

            $input['password'] = Hash::make($input['password']);

        Employee::create([
            'emp_name'=>$request ->emp_name,
            'institution_id'=>$request -> inst_name,

             'appation_date'=>$request -> appation_date,
             'age'=>$request ->age,
            'primary_sal'=>$request ->primary_sal,
            'tax_value' => $request->primary_sal*5/100,
            'email'=>$request ->email,
            'password' =>$request -> password,

        ]);
            DB::commit();

            return redirect()->route('employees')
                ->with('success','تم اضافة  الموظف بنجاح');

        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex;
            return $ex;

            return redirect()->route('employees')
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
        $emp = Employee::findOrFail($id);
        $institution = Institution::all();

        return view('employee.edit',compact('emp', 'institution'));



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
            Employee::find($request->id)->update([
                'emp_name' => $request->emp_name,
                'institution_id' => $request->inst_name,
                'appation_date' => $request->appation_date,
                'age' => $request->age,
                'primary_sal' => $request->primary_sal,
               // 'tax_value' => $request->tax_value,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            DB::commit();

            return redirect()->route('employees')
                ->with('success', 'تم تعديل بيانات الموظف بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();

            return redirect()->route('employees')
                ->with('success', 'لم يتم تعديل بيانات الموظف حدث خطا');


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
            $employees = Employee::find($id);
            if (!$employees)

                Session::flash('message', 'Delete not successfully!');
            Session::flash('alert-class', 'alert-danger');


            $employees->delete();

            Session::flash('message', 'Delete successfully!');
            Session::flash('alert-class', 'alert-success');

            return redirect()->route('employees')
                ->with('success','تم حذف الموظف بنجاح');


        } catch (\Exception $ex) {
            return redirect()->route('employees')->with(['error' => 'حدث خطا ما الرجاء المحاولة لاحقا']);
        }

    }

}

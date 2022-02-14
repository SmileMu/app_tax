<?php

namespace App\Http\Controllers;
use App\Institution;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Institutation;
use App\Section;
use App\Type;
use Hash;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inistitution = Institution::all();
        //return $inistitution;
        return view('inistitution.show', compact('inistitution'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type =  Type::all();
        $section =  Section::all();
        return view('inistitution.add', compact('type','section'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
    {
        $validatedData = $request->validate([

            'name' =>  'required|min:3',
            'date' => 'required',
            'type_name' => 'required',
             'section_type' => 'required',
             'location' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
      //  return $request;
        try {
            DB::beginTransaction();
            $input = $request->all();

            $input['password'] = Hash::make($input['password']);

            Institution::create([
            'inst_name'=>$request ->name,
            'found_year'=>$request ->date,
            'type_id'=>$request ->type_name,
            'section_id'=>$request ->section_type,
            'location'=>$request ->location,
            'phone_no'=>$request ->phone,
            'email'=>$request ->email,
                'password' =>$request -> password,



        ]);
            DB::commit();

            return redirect()->route('institutions')
                ->with('success','تم اضافة  المؤسسه بنجاح');

        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex;

            return redirect()->route('institutions')
                ->with('error','حدث خطا ما الرجاء المحاوله لاحقا');


        }
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
        $inst = DB::table('institutions')->get();
        return View::make('show.inst')->with(array('institutions'=>$inst));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type =  Type::all();
        $section =  Section::all();
        $inistitution = Institution::findOrFail($id);

        return view('inistitution.edit',compact('inistitution','type','section'));

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
            Institution::find($request->id)->update([
                'inst_name'=>$request ->name,
                'found_year'=>$request ->date,
                'type_id'=>$request ->type_name,
                'section_id'=>$request ->section_type,
                'location'=>$request ->location,
                'phone_no'=>$request ->phone,
                'email'=>$request ->email,
                'password' =>$request -> password,
            ]);

            DB::commit();

            return redirect()->route('institutions')
                ->with('success','تم تعديل بيانات المؤسسه بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();

            return redirect()->route('institutions')
                ->with('success','لم يتم تعديل بيانات المؤسسه حدث خطا');

        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        try {
            //validation
            //update database
            $institution = Institution::find($id);
            if (!$institution)

                Session::flash('message', 'Delete not successfully!');
            Session::flash('alert-class', 'alert-danger');


            $institution->delete();

            Session::flash('message', 'Delete successfully!');
            Session::flash('alert-class', 'alert-success');

            return redirect()->route('institutions')
                ->with('success','تم حذف المؤسسه بنجاح');


        } catch (\Exception $ex) {
            return redirect()->route('institutions')->with(['error' => 'حدث خطا ما الرجاء المحاولة لاحقا']);
        }

    }
}

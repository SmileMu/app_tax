<?php
//use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;
use App\Section;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Session;
use DB;
use App\type;
use App\Institutation;

class SectiontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Section::all();
        return view('sections.show', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sections.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            Section::create([
                'section_type'=>$request ->type,
                'description'=>$request ->description,

            ]);

            DB::commit();

            return redirect()->route('setions')
                ->with('success','تم اضافة قطاع بنجاح');



        } catch (\Exception $ex) {
            DB::rollBack();

            return redirect()->route('types')
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

        $type=DB::table('types')->get();
        return View::make('show.type')->with(array('types'=>$type));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = Section::findOrFail($id);

        return view('sections.edit',compact('type'));

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
            Section::find($request->id)->update([
                'section_type'=>$request ->type,
                'description'=>$request ->description,

            ]);

            DB::commit();

            return redirect()->route('setions')
                ->with('success','تم تعديل نوع المؤسسه بنجاح');
        } catch (\Exception $ex) {
            DB::rollBack();

            return redirect()->route('setions')
                ->with('success','لم يتم تعديل نوع المؤسسه حدث خطا');

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
            $type = Section::find($id);
            if (!$type)

                Session::flash('message', 'Delete not successfully!');
            Session::flash('alert-class', 'alert-danger');


            $type->delete();

            Session::flash('message', 'Delete successfully!');
            Session::flash('alert-class', 'alert-success');

            return redirect()->route('setions')
                ->with('success','تم تعديل نوع المؤسسه بنجاح');


        } catch (\Exception $ex) {
            return redirect()->route('setions')->with(['error' => 'حدث خطا ما الرجاء المحاولة لاحقا']);
        }

    }
}

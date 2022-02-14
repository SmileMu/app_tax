<?php
//use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Session;
use DB;
use App\type;
use App\Institutation;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Type::all();
        return view('types.show', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('types.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  return $request;

        try {
            DB::beginTransaction();

            Type::create([
                'type_name'=>$request ->type,
                'description'=>$request ->description,

            ]);

            DB::commit();

            return redirect()->route('types')
                ->with('success','تم اضافة نوع المؤسسه بنجاح');



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
        $type = Type::findOrFail($id);

        return view('types.edit',compact('type'));

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
            Type::find($request->id)->update([
                'type_name'=>$request ->type,
                'description'=>$request ->description,

            ]);

            DB::commit();

            return redirect()->route('types')
                ->with('success','تم تعديل نوع المؤسسه بنجاح');
    } catch (\Exception $ex) {
            DB::rollBack();

            return redirect()->route('types')
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
            $type = Type::find($id);
            if (!$type)

                Session::flash('message', 'Delete not successfully!');
            Session::flash('alert-class', 'alert-danger');


            $type->delete();

            Session::flash('message', 'Delete successfully!');
            Session::flash('alert-class', 'alert-success');

            return redirect()->route('types')
                ->with('success','تم حذف نوع المؤسسه بنجاح');


             } catch (\Exception $ex) {
            return redirect()->route('types')->with(['error' => 'حدث خطا ما الرجاء المحاولة لاحقا']);
        }

   }
}

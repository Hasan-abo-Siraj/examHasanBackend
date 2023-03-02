<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreindex()
    {

        $companies = Company::onlyTrashed()->orderBy('id' , 'desc')->paginate(10);
        return response()->view('cms.company.index' , compact('companies'));
    }

    //  function restore
    public function restore( $id)
    {
        $companies = Company::onlyTrashed()->findOrfail($id)->restore();
        return redirect()->back();

    }

    public function index(Request $request)
    {

        $companies = Company::withCount('branches')->orderBy('id' ,'desc')->paginate(5);


        // if ($request->get('name')) {
        //     $companies = Company::where('name', 'like', '%' . $request->name . '%');
        // }
        // if ($request->get('email')) {
        //     $companies = Company::where('email', 'like', '%' . $request->email . '%');
        // }



        return response()->view('cms.company.index' , compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator($request->all() , [
            // 'name' => 'required|string|min:3|max:20',
            // 'code' => 'required|numeric|digits:3',
        ] , [
            // 'name.required' => 'هذا الحقل مطلوب' ,
            // 'name.min' => 'لا يمكن اضافة اقل من 3 حروف' ,
            // 'name.max' => 'لا يمكن أضافة اكثر من 20 حرف'

        ]);

        if(! $validator->fails()){

            $companies = new Company();
            $companies->name = $request->get('name');
            $companies->email = $request->get('email');
            $companies->password = Hash::make($request->get('password'));
            $companies->status = $request->get('status');
            $companies->desc = $request->get('desc');

            $isSaved = $companies->save();

            if($isSaved){
                return response()->json(['icon' => 'success' , 'title' => "Created is Successfully"] , 200);
            }
            else{
                return response()->json(['icon' => 'error' , 'title' => "Created is Failed"] , 400);
            }
        }
        else{
            return response()->json(['icon'=>'error' , 'title' => $validator->getMessageBag()->first()] , 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branches = Branch::findOrFail($id);
        $companies = company::findOrFail($id);
        return response()->view('cms.company.show' , compact('branches','companies' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::findOrFail($id);
        return response()->view('cms.company.edit' , compact('companies'));
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
        $validator = Validator($request->all() , [
            // 'name' => 'required|string|min:3|max:20',
            // 'code' => 'required|numeric|digits:3',
        ]);

        if (! $validator->fails()){

            $companies = Company::findOrFail($id);
            $companies->name = $request->get('name');
            $companies->email = $request->get('email');
            // $companies->password = Hash::make($request->get('password'));
            $companies->status = $request->get('status');
            $companies->desc = $request->get('desc');

            $isUpdated = $companies->save();
            return ['redirect' => route('companies.index')];
            if($isUpdated){
                return response()->json(['icon' => 'success' , 'title' => 'Updated is Successfully'] , 200);
            }
            else{
                return response()->json(['icon' => 'error' , 'title' => 'Updated is Failed'] , 400);

            }
        }
        else{
            return response()->json(['icon' => 'error' , 'title' => $validator->getMessageBag()->first()] , 400);
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
        // $companies = Company::destroy($id);
        // return response()->json(['icon' => 'success' , 'title'=> "Deleted is Successfully"] , 200);
        $companies= Company::withTrashed()->find($id);

        if($companies->deleted_at == null){
            $companies = Company::destroy($id);

            return response()->json(['icon' => 'success' , 'title' => "Deleted is successfully"] , 200);
        }

    //  function forceDelete

        if($companies->deleted_at !== null){
            $companies->forceDelete();

            return response()->json(['icon' => 'success' , 'title' => "Deleted is Data Base successfully"] , 200);
        }
    }
}

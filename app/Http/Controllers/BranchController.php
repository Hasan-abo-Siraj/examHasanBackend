<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $branches = Branch::with('company')->orderBy('id' , 'desc')->Paginate(10);
        return response()->view('cms.branch.index' , compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return response()->view('cms.branch.create' , compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all() ,[
            // 'name' => 'required|string|min:4' ,
            // 'company_id' => 'required'
        ]);

        if(! $validator->fails()){
            $branches = new Branch();
            $branches->name = $request->input('name');
            $branches->email = $request->get('email');
            $branches->password = Hash::make($request->get('password'));
            $branches->status = $request->get('status');
            $branches->desc = $request->get('desc');
            $branches->company_id = $request->get('company_id');

            $isSaved = $branches->save();

            return response()->json(['icon' => $isSaved ? 'success' : 'error' , 'title' => $isSaved ? "Created is Successfully" : "Created is Failed"] , $isSaved ? 200 : 400);

        }

        else{
            return response()->json(['icon' => 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
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
        $companies = Company::all();
        $branches = Branch::findOrFail($id);
        return response()->view('cms.branch.show' , compact('companies','branches' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $branches = Branch::all();
        return response()->view('cms.branch.edit' , compact('companies' , 'branches'));
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
        $validator = Validator($request->all() ,[
            // 'name' => 'required|string|min:4' ,
            // 'company_id' => 'required'
        ]);

        if(! $validator->fails()){
            $branches = new Branch();
            $branches->name = $request->input('name');
            $branches->email = $request->get('email');
            $branches->password = Hash::make($request->get('password'));
            $branches->status = $request->get('status');
            $branches->desc = $request->get('desc');

            $branches->company_id = $request->get('company_id');

            $isUpdate = $branches->save();
            return ['redirect' => route('branches.index')];

            // return ['redirect' => route('branches.index')];
            return response()->json(['icon' => $isUpdate ? 'success' : 'error' , 'title' => $isUpdate ? "Created is Successfully" : "Created is Failed"] , $isUpdate ? 200 : 400);

        }

        else{
            return response()->json(['icon' => 'error' , 'title' =>$validator->getMessageBag()->first()] , 400);
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
        $branches = Branch::destroy($id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Branch;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{

    public function index()
    {
        $authors = Author::withCount('articles')->orderBy('id' , 'desc')->paginate(5);
        return response()->view('cms.author.index' , compact('authors'));

    }
  public function create()
    {
        $branches = Branch::all();
        return response()->view('cms.author.create' , compact('branches'));
    }
 public function store(Request $request)
    {
        $validator = Validator($request->all() ,[
            'email' => 'required|email',

        ]);
        if(! $validator->fails()){
            $authors = new Author();
            $authors->email = $request->get('email');
            $authors->password = Hash::make($request->get('password'));
            $isSaved = $authors->save();
            if($isSaved){
                $users = new User();
                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/Author', $imageName);

                    $users->image = $imageName;
                    }

                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->date = $request->get('date');
                $users->branch_id = $request->get('branch_id');
                $users->address = $request->get('address');
                $users->mobile = $request->get('mobile');
                $users->actor()->associate($authors);

                $isSaved = $users->save();

                return response()->json(['icon' => 'success' , 'title' => 'Created is Successfully'] , 200);

            }
        }
        else{
            return response()->json(['icon' => 'error' , 'title'=>$validator->getMessageBag()->first()] , 400);
        }
    }
    public function show($id)
    {

    }

    public function edit($id)
    {
        $authors = Author::findOrFail($id);
        $branches = Branch::all();
        return response()->view('cms.Author.edit' , compact('authors' , 'branches'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator($request->all() , [
            'password' => 'nullable',
        ]);

        if(! $validator->fails()){
            $authors = Author::findOrFail($id);
            $authors->email = $request->get('email');
            $isSaved = $authors->save();
            if($isSaved){
                $users = $authors->user;

                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/Author', $imageName);

                    $users->image = $imageName;
                    }

                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->date = $request->get('date');
                $users->branch_id = $request->get('branch_id');
                $users->address = $request->get('address');
                $users->mobile = $request->get('mobile');
                $users->actor()->associate($authors);

                $isSaved = $users->save();

                return ['redirect'=>route('authors.index')];

            }
        }
        else{
            return response()->json(['icon' => 'error' , 'title' => $validator->getMessageBag()->first()] ,400);
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
        $Authors = Author::destroy($id);
    }
}

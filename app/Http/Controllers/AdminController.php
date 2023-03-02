<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdminEmail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function restore($id){
    //     $restore = Admin::onlyTrashed()->findOrFail($id)->restore();

    //     if ( $restore) {
    //         echo "Success Restore Data";
    //     }

    // }
    // public function forceDelete($id){
    //     $restore = Admin::findOrFail($id)->forceDelete();

    //     if ( $restore) {
    //         echo "Success ForceDelete Data";
    //     }

    // }



    public function restoreindex()
    {
        $admins = Admin::onlyTrashed()->with('user')->orderBy('id' , 'desc')->paginate(10);
        return response()->view('cms.admin.index' , compact('admins'));
    }

    //  function restore
    public function restore( $id)
    {
        $admins = Admin::onlyTrashed()->findOrfail($id)->restore();
        return redirect()->back();

    }

    public function index()
    {
        // $admins = Admin::orderBy('id' , 'desc')->paginate(5);
        $admins = Admin::withoutTrashed()->orderBy('id' , 'desc')->paginate(5);
        // $this->authorize('viewAny' , Admin::class);
        return response()->view('cms.admin.index' , compact('admins'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();

        return response()->view('cms.admin.create' , compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *  $users->actor()->associate($admins);

     */
    public function store(Request $request)
    {
        $validator = Validator($request->all() ,[
            'email' => 'required|email',

        ]);
        if(! $validator->fails()){
            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));
            $isSaved = $admins->save();
            if($isSaved){
                $users = new User();

                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/admin', $imageName);

                    $users->image = $imageName;
                    }

                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->date = $request->get('date');
                // $users->branch_id = $request->get('branch_id');
                $users->address = $request->get('address');
                $users->mobile = $request->get('mobile');
                $users->actor()->associate($admins);

                $isSaved = $users->save();

                    Mail::to($admins->email)->send(new AdminEmail($admins->email));


                return response()->json(['icon' => 'success' , 'title' => 'Created is Successfully'] , 200);

            }
        }
        else{
            return response()->json(['icon' => 'error' , 'title'=>$validator->getMessageBag()->first()] , 400);
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
        $admins = Admin::findOrFail($id);
        $branches = Branch::all();
        return response()->view('cms.admin.show' , compact('admins','branches' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins = Admin::findOrFail($id);
        $branches = Branch::all();
        // $this->authorize('update' , Admin::class);

        return response()->view('cms.admin.edit' , compact('admins' , 'branches'));
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
            'password' => 'nullable',
        ]);

        if(! $validator->fails()){
            $admins = Admin::findOrFail($id);
            $admins->email = $request->get('email');
            $isSaved = $admins->save();

            if($isSaved){
                $users = $admins->user;

                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/admin', $imageName);

                    $users->image = $imageName;
                    }

                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->date = $request->get('date');
                // $users->branch_id = $request->get('branch_id');
                $users->address = $request->get('address');
                $users->mobile = $request->get('mobile');
                $users->actor()->associate($admins);

                $isSaved = $users->save();

                return ['redirect'=>route('admins.index')];

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
        // $admins = Admin::destroy($id);
        // $this->authorize('delete' , Admin::class);
        $admins= Admin::withTrashed()->find($id);

        if($admins->deleted_at == null){
            $admins = Admin::destroy($id);

            return response()->json(['icon' => 'success' , 'title' => "Deleted is successfully"] , 200);
        }

    //  function forceDelete

        if($admins->deleted_at !== null){
            $admins->forceDelete();

            return response()->json(['icon' => 'success' , 'title' => "Deleted is Data Base successfully"] , 200);
        }


    }

    public function changeStatus(Request $request)
    {
        $admins = Admin::with('user')->find($request->id);
        $admins->user->status = $request->get('unit_toggle_value');
        $isSave = $admins->save();
        return response()->json(['icon' => 'success', 'title' => 'تم التعديل  بنجاح'], $isSave ? 200 : 400);
    }
}

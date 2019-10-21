<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $employee = Employee::with('company')->orderBy('id', 'DESC')->get();
         return response()->json($employee);
        // return $employee->toJson();

    }


    public function index1()
    {
        return view('enovate');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //return $request->all();
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'photo' => 'required',
            'company_id' => 'required',

        ]);


            $name = time(). '.' . explode('/', explode(':', substr($request->photo,0,strpos
            ($request->photo, ';'))) [1] ) [1];
            \Image::make($request->photo)->save( public_path('img/photos/').$name );
             $request->merge(['photo' => $name]);


        $data = $request->except(['_token']);

        $newEmployee = Employee::forceCreate($data);
        return $newEmployee->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $employee)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'photo' => 'required',
            'company_id' => 'required',
        ]);


        $imageName = time(). '.' . explode('/', explode(':', substr($request->photo,0,strpos
        ($request->photo, ';'))) [1] ) [1];
        \Image::make($request->photo)->save( public_path('img/photos/').$imageName );
           //$request->merge(['photo' => $imageName]);

           $request->photo = $imageName;

        $emp = Employee::find($employee);
        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->photo = $imageName;
        $emp->company_id = $request->company_id;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return ['message' => 'emplo$employee Deleted'];
    }
}






// $currentPhoto = $user->photo;

// if($request->photo != $currentPhoto){

//     $name = time(). '.' . explode('/', explode(':', substr($request->photo,0,strpos
//     ($request->photo, ';'))) [1] ) [1];

// \Image::make($request->photo)->save( public_path('img/profile/').$name );

//     $request->merge(['photo' => $name]);

//     //delete old photo if user changes/updates profile pic
//     $userPhoto = public_path('img/profile/').$currentPhoto;
//     if(file_exists($userPhoto)){
//         @unlink($userPhoto);
//     }
// }

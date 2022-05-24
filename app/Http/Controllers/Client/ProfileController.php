<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return Inertia::render('User/ProfileEdit',[
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
            ],
            'company'=>[
                'name'=>$user->company->name ?? '',
                'email'=>$user->company->email ?? '',
                'phone'=>$user->company->phone ?? '',
                'address'=>$user->company->address ?? '',
                'website_url'=>$user->company->website_url ?? '',
                'is_owner'=>$user->company->is_owner ?? ''
            ]
        ]);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
        ]);

        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator);
        }
        $user = auth()->user();
        $user->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function changePassword(Request $request)
    {
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'new_password' => ['required', 'string', 'min:8','confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $user->update([
            'password' => Hash::make($request->new_password),

        ]);        
        return redirect()->back();

    }
    public function updateCompanyInfo(Request $request){
        
        
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'string', 'email'],
        ]);

        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator);
        }
        $user = auth()->user();
        $company = Company::updateOrCreate([
            'user_id'   => $user->id,
        ],$request->all());
        return redirect()->back();

       
    }
}

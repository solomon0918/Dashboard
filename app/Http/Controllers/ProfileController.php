<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRole;
use App\Attorney;
use Validator;
use Hash;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user)
    {
        if($request->user()->authorizeRoles(['Client', 'Attorney', 'Administrator'])){
            $profileInfo = $request->user();
            return view('profile')->with('profileInfo', $profileInfo);
        }else{
            return redirect('/login');
        }
        // echo $request->user();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user, $id)
    {
        if($id){
            switch($id){
                case 1: //Personal Information
                    try{
                        $validator = Validator::make($request->all(), [
                            'first_name' => 'required',
                            'last_name' => 'required',
                            'dob' => 'required|date',
                            'city' => 'required',
                            'state' => 'required'
                        ]);

                        if ($validator->fails()) {
                            return response()->json(['Error' => true, 'Success' => false, 'Message' => $validator->messages()]);
                        }

                        $userInfo = $request->user();
                        $userInfo->first_name = $request->input('first_name');
                        $userInfo->middle_name = $request->input('middle_name');
                        $userInfo->last_name = $request->input('last_name');
                        $userInfo->dob = $request->input('dob');
                        $userInfo->phone = $request->input('phone');
                        $userInfo->street_address = $request->input('address');
                        $userInfo->city = $request->input('city');
                        $userInfo->state = $request->input('state');
                        $userInfo->zip = $request->input('zip');

                        $userInfo->save();

                        return response()->json(['Error' => false, 'Success' => true, 'Message' => 'Personal Information Saved!']);
                    }catch(Exception $e){
                        return response()->json(['Error' => true, 'Success' => false, 'Message' => 'Personal Information Error: ' . htmlspecialchars($e->getMessage()) . ". Please Contact Us."]);
                    }
                    break;
                case 2: //Account Information
                    try{
                        $validator = Validator::make($request->all(), [
                            'email' => 'required|email',
                        ]);

                        if ($validator->fails()) {
                            return response()->json(['Error' => true, 'Success' => false, 'Message' => $validator->messages()]);
                        }

                        $userInfo = $request->user();
                        $userInfo->email = $request->input('email');

                        $userInfo->save();

                        return response()->json(['Error' => false, 'Success' => true, 'Message' => 'Account Information Saved!' ]);
                    }catch(Exception $e){
                        return response()->json(['Error' => true, 'Success' => false, 'Message' => 'Account Information Error: ' . htmlspecialchars($e->getMessage()) . ". Please Contact Us."]);
                    }
                    break;
                case 3: //Attorney Information
                    if($user == 'attorney'){
                        try{
                            $validator = Validator::make($request->all(), [
                                'state-bar-number' => 'required|integer',
                                'business-zip' => 'integer',
                                'bio' => 'required'
                            ]);

                            if ($validator->fails()) {
                                return response()->json(['Error' => true, 'Success' => false, 'Message' => $validator->messages()]);
                            }

                            $request->user()->attorney()->update(
                                [
                                    'state_bar_number' => $request->input('state-bar-number'),
                                    'primary_attorney_ssn' => $request->input('primary-attorney-ssn'),
                                    'business_tax_id' => $request->input('business-tax-id'),
                                    'business_name' => $request->input('business-name'),
                                    'business_address' => $request->input('business-address'),
                                    'business_city' => $request->input('business-city'),
                                    'business_state' => $request->input('business-state'),
                                    'business_zip' => $request->input('business-zip'),
                                    'bio' => $request->input('bio')
                                ]
                            );

                            return response()->json(['Error' => false, 'Success' => true, 'Message' => 'Account Information Saved!' ]);
                        }catch(Exception $e){
                            return response()->json(['Error' => true, 'Success' => false, 'Message' => 'Attorney Information Error: ' . htmlspecialchars($e->getMessage()) . ". Please Contact Us."]);
                        }
                    }else{
                        return response()->json(['Error' => true, 'Success' => false, 'Message' => "Method not allowed!"]);
                    }
                    
                    break;
                case 4: //Change Password
                    try{
                        $validator = Validator::make($request->all(), [
                            'oldPassword' => 'required',
                            'newPassword' => 'required',
                            'confirmPassword' => 'required|same:newPassword'
                        ]);

                        if ($validator->fails()) {
                            return response()->json(['Error' => true, 'Success' => false, 'Message' => $validator->messages()]);
                        }

                        $oldPassword = $request->input('oldPassword');
                        $newPassword = $request->input('newPassword');
                        $confirmPassword = $request->input('confirmPassword');
                        $userInfo = $request->user();
                        //Check old Password
                        if(Hash::check($oldPassword, $userInfo->password)){

                            $userInfo->password = Hash::make($newPassword);

                            $userInfo->save();

                            return response()->json(['Error' => false, 'Success' => true, 'Message' => 'Account Information Saved!']);
                        }else{
                            return response()->json(['Error' => true, 'Success' => false, 'Message' => ['oldPassword' => 'Old Password doesn\'t match']]);
                        }

                        
                    }catch(Exception $e){
                        return response()->json(['Error' => true, 'Success' => false, 'Message' => 'Changing Password Error: ' . htmlspecialchars($e->getMessage()) . ". Please Contact Us."]);
                    }
                    break;
                default:
                    break;
            }
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
        //
    }
}

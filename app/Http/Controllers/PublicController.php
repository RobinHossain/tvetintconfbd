<?php

namespace App\Http\Controllers;

use App\RegistrationForm;
use Illuminate\Http\Request;
use Validator;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('');
    }

	public function registrationGet()
	{
		return view('public.registration');
	}

	public function registrationPost( Request $request ){
		$this->validate($request, [
			'fname' => 'required',
			'lname' => 'required',
			'profile_photo' => 'required',
			'nationality' => 'required',
			'gender' => 'required',
			'birthday' => 'required',
			'occupation' => 'required',
			'country' => 'required',
			'address' => 'required',
			'city' => 'required',
			'zip' => 'required',
			'email' => 'required|email',
			'phone' => 'required',
			'nid' => 'required',
			'pass_iss_country_name' => 'required',
			'pass_expire_date' => 'required',
			'fee_amount' => 'required',
			'currency' => 'required',
			'bank_deposit_slip' => 'required',
		]);

		if($request->profile_photo){
			$origin_name = $request->profile_photo->getClientOriginalName();
			$extension = pathinfo($origin_name, PATHINFO_EXTENSION);
			$uploaded_profile_photo = $origin_name.'_'.rand(100,9239837).'.'.$extension;
			$request->profile_photo->move(public_path('public/user_files'), $uploaded_profile_photo);
		}

		if($request->bank_deposit_slip){
			$origin_name = $request->bank_deposit_slip->getClientOriginalName();
			$extension = pathinfo($origin_name, PATHINFO_EXTENSION);
			$uploaded_deposit_slip = $origin_name.'_'.rand(100,9239837).'.'.$extension;
			$request->bank_deposit_slip->move(public_path('public/user_files'), $uploaded_deposit_slip);
		}

		$registration = new RegistrationForm;
		$registration->fname = $request->fname;
		$registration->lname = $request->lname;
		$registration->profile_photo = $request->profile_photo;
		$registration->nationality = $request->nationality;
		$registration->gender = $request->gender;
		$registration->birthday = $request->birthday;
		$registration->occupation = $request->occupation;
		if( $request->organization ){ $registration->organization = $request->organization; }
		$registration->country = $request->country;
		$registration->address = $request->address;
		$registration->city = $request->city;
		$registration->zip = $request->zip;
		$registration->email = $request->email;
		$registration->phone = $request->phone;
		$registration->nid = $request->nid;
		$registration->pass_iss_country_name = $request->pass_iss_country_name;
		$registration->pass_expire_date = $request->pass_expire_date;
		if( $request->tvet_1 ){ $registration->tvet_1 = 1; }
		if( $request->tvet_2 ){ $registration->tvet_2 = 1; }
		if( $request->tvet_3 ){ $registration->tvet_3 = 1; }
		if( $request->tvet_4 ){ $registration->tvet_4 = 1; }
		if( $request->tvet_5 ){ $registration->tvet_5 = 1; }
		if( $request->tvet_6 ){ $registration->tvet_6 = 1; }
		$registration->fee_amount = $request->fee_amount;
		$registration->currency = $request->currency;
		$registration->bank_deposit_slip = $request->bank_deposit_slip;

		$registration->save();

		$request->session()->flash('status', 'The registration was successful!');

		return redirect('registration/')->send();

//		pr($request->input());
	}
}

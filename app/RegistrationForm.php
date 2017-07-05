<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationForm extends Model
{
    //
	protected $table = 'registration_form';
	protected $dates = [ 'created_at', 'updated_at' ];
	protected $fillable = [
		'fname', 'lname', 'profile_photo', 'nationality', 'gender', 'birthday', 'occupation', 'organization', 'country',
		'address', 'city', 'zip', 'email', 'phone', 'nid', 'pass_iss_country_name', 'pass_expire_date', 'tvet_1',
		'tvet_2', 'tvet_3', 'tvet_4', 'tvet_5', 'tvet_6', 'fee_amount', 'currency', 'bank_deposit_slip'
	];
}

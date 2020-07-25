<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CommonHelper 
{

    /**
     * To generate unique id for user
     *
     * @author RAHUL PA
     * 
     * @return integer/false
     */
    public function generateUniqueId()
    {
        return strtoupper(uniqid());
    }

    /**
     * generate random string and encrypt it. 
     *
     * @return string
     */
    public static function generatePassword()
    {
      return Hash::make(Str::random(35));
    }
    /**
     * generate remeber token with email. 
     *
     * @return string
     */
    public static function generateRememberToken($email)
    {
      return Hash::make($email);
    }

    public function getValidationMessage()
    {
        return [
          'required'  =>  'The :attribute field is required.',
          'unique'    =>  'The :attribute is already exist.',
          'email'     =>  'The :attribute must be a email.',
          'regex'     =>  'The :attribute is not valid.',
          'digits'    =>  'The :attribute must be :digits  digits.',
          'max'       =>  'The :attribute must be less than :max.',
          'min'       =>  'The :attribute must be greater than :min.',
          'numeric'   =>  'The :attribute must a numeric value.'
        ];
    }


    
}
<?php
namespace App\Http\Controllers\Api;


/*
 * This function organizes the transfer of data from the
 * API to the phone or the receiver in one way without any difference
 */

use Illuminate\Support\Facades\Validator;

Trait ApiResponseTrait {

    public $paginate = 10;

    public  function  ResponseTrait($data = null , $error = null , $code = 200){

        $array = [

            'data' => $data,
            'status' => in_array($code , $this->checked_code()) ? true : false,
            'error' => $error
            ];
        return response($array , $code);
    }

    public  function checked_code(){
        return [200,201,202];
    }

    public  function not_found(){
        return $this->ResponseTrait(null ,'not found!',404);
    }

    //Validator title and body
    public  function Validators($request,$array){
        $validator = Validator::make($request->all(), $array);
        if ($validator->fails()) {
        return $this->ResponseTrait(null ,$validator->errors(),422);
        }
    }

    //Some Error
    public  function Some_error(){
    return $this->ResponseTrait(null ,'some error!!',520);
    }

    //Creating Response
    public  function creating_Response($data){
        return $this->ResponseTrait($data ,null ,201);
    }


    //Delete Response
    public  function delete_Response(){
        return $this->ResponseTrait($data = true,null ,200);
    }


}

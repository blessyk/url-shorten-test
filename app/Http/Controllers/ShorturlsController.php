<?php

namespace App\Http\Controllers;

use App\Shorturls;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Helpers\CommonHelper;
use Validator;

class ShorturlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $data;
    /**
     * Http response code
     */
    private $code;
    /**
     * Response status
     */
    private $success;
    /**
     * Response message
     */
    private $message;
    /**
     * Init class attributes
     */
    public function __construct(Request $request)
    {
        $this->data     = [];
        $this->code     = Response::HTTP_OK;
        $this->success  = true;
        $this->message  = '';
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    
        $validator = Validator::make($request->all(), $this->getCreateurlRules(), (new CommonHelper())->getValidationMessage());
        if ($validator->fails()) 
        {
            $this->success  = false;
            $this->message  = "Validation Error!";
            $this->data     = [ 'errors' => $validator->errors()];
        }
        else
        {
            $shorturls= new Shorturls;   
            $shorturls->longurl = $request->get('url');
            $shorturls->date=date('Y-m-d H:i:s'); 
            $shorturls->shorturl=substr(md5(uniqid(rand(), true)),0,6);
            $shorturls->counter=1;
           
            if(!$shorturls->save())
            {
                $this->success = false;
                $this->message = 'Failed to create url';
            }
            else
            {
                $this->message  = "url created successfully!";
                $this->data     = [ 'shorturls' => $shorturls ];
            }
        }
        // response
        return response()->json([
            'success'   => $this->success,
            'message'   => $this->message ,
            'data'      => $this->data
        ], $this->code);

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
     * @param  \App\shorturls  $shorturls
     * @return \Illuminate\Http\Response
     */
    public function show(shorturls $shorturls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\shorturls  $shorturls
     * @return \Illuminate\Http\Response
     */
    public function edit(shorturls $shorturls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\shorturls  $shorturls
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shorturls $shorturls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\shorturls  $shorturls
     * @return \Illuminate\Http\Response
     */
    public function destroy(shorturls $shorturls)
    {
        //
    }
     private function getCreateurlRules()
    {
        return [
            'url'    => 'required|max:30',
        ];
    }
}

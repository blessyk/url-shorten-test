<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Shorturls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Helpers\CommonHelper;
use App\Visitregister;
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
             $rowcount=(Shorturls::where('longurl', $request->get('url'))->get())->count();

            if($rowcount>=1)
            {
                $shorturls=Shorturls::where('longurl', $request->get('url'))->first();
               // dd($shorturls);
                $shorturls->counter=$shorturls->counter+1;
                $shorturls->save();
                $this->message  = "url created successfully!";
                $this->data     = [ 'shorturls' => $shorturls ];
                    
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
    public function geturls()
    {  
        $date = date('Y-m-d H:i:s', strtotime('-1 hour'));
        $urls=Shorturls::select('shorturls.longurl',Visitregister::raw('count(*) as count'))
        ->join('visitregisters', 'visitregisters.url_id', '=', 'shorturls.id')
        ->groupBy('shorturls.longurl')
        ->get();
      return response()->json(['success'=>true, 'urls'=>$urls]);
    }
    public function geturls1()
    {  
        $date = date('Y-m-d H:i:s', strtotime('-1 hour'));
        $urls=Shorturls::select('shorturls.longurl',Visitregister::raw('count(*) as count'))
        ->join('visitregisters', 'visitregisters.url_id', '=', 'shorturls.id')
        ->where('visitregisters.date', '>=', $date)
        ->groupBy('shorturls.longurl')
        ->get();
      
        return response()->json(['success'=>true, 'urls'=>$urls]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\shorturls  $shorturls
     * @return \Illuminate\Http\Response
     */
    public function show($val)
    {
     $url=Shorturls::where('shorturl',$val)->first();
     $visitregister=new Visitregister();
     $visitregister->url_id=$url->id;
     $visitregister->date=date('Y-m-d H:i:s');
     $visitregister->save();
     return redirect($url->longurl);
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
            'url'    => 'required|max:3000',
        ];
    }
}

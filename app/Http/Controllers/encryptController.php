<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\encryptModel;
use Auth;


class encryptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $uesrText = $request->input('text');
        $encType = $request->input('enctype');
        $this->validate($request, [
            'text' => 'required|min:2|max:255',
            'enctype' => array(

                'required',
                'regex:/^(MD5|Hillcypher|Cypher)$/'

            ),
        ]);

        if ($encType == "MD5") {
            $encText = md5($uesrText);
            return back()->with('success','Success')->with('enct',$encText);
        }
        if($encType=="Hillcypher"){

        }

    }


    public function publickey(){
        return view('publickey.publickey');
    }

    public function pkentext(Request $request)
    {
        $uesrText = $request->input('text');
        $Type = $request->input('type');
        $this->validate($request, [
            'text' => 'required|min:2|max:255',
            'type' => array(

                'required',
                'regex:/^(Encrypt|Decrypt)$/'

            ),
        ]);

        if ($Type=='Encrypt') {
            $encrypted = Crypt::encryptString($request->input('text'));

            $insert = new encryptModel;

             $insert->user_id = Auth::user()->id;
             $insert->username = Auth::user()->name;
             $insert->en_text = $encrypted;
             $insert->save();


           return back()->with('success','Success')->with('enct',$encrypted);
        }

        if ($Type=='Decrypt') {
            $decrypted = Crypt::decryptString($request->input('text'));

           return back()->with('success','Success')->with('enct',$decrypted);
        }

    }

    public function calculatePublicKey(Request $request){


        $fp=fopen("public/public.txt","r");
        $key=fread($fp,8192);
         $data = $request->input('text');
         $key=$request->input('key');
         $publickey=openssl_csr_get_public_key($key);
         $type=$request->input('enctype');
         if($type=='Encrypt'){
         openssl_public_encrypt($data, $encrypted, $publickey);
         return $encrypted;
       }
       else if($type=='Decrypt'){

             $data = $request->input('text');
             $key=$request->input('key');
           //  $publickey=openssl_csr_get
             $type=$request->input('enctype');




    }
}
public function simpleaes(Request $request){

    $data = $request->input('text');
     $type=$request->input('enctype');
     $encrypted="";
     if($type=='encrypt'){
        $encrypted = Crypt::encryptString($data);
     }
     if($type=='decrypt'){
        $encrypted = Crypt::decryptString($data);
     }


    return view('aes',['enct'=>$encrypted]);
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
    public function update(Request $request, $id)
    {
        //
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

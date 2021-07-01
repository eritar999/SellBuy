<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Mail;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return 69;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return 69;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user == null){
            return redirect('/index')->with('success','Profile not found!');;
        }
        //$sponsors = $user->remejas;
        return view('auth.show')->with('user', $user);//->with('players', $players)->with('sponsors', $sponsors);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if($user->id != Auth::id()){
            return redirect('/index')->with('error','This is not your profile.');;
        }
        return view('auth.edit')->with('user', $user);
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
        $user = User::find($id);

        if($request->hasfile('profilio_nuotrauka')){
            //return 'file';
            //return $request->file('profilio_nuotrauka');
            $user->profilio_nuotrauka = file_get_contents($request->file('profilio_nuotrauka'));
             //= $image;
            //$request->allFiles()
        }


        //return view('auth.show')->with('user', $user);
        $user->save();
        return redirect('/index')->with('success','Profile updated!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        //dd($user->komentarai());
        $user->komentarai()->delete();


        $user->skelbimai()->delete();

        //return $user;
        $user->delete();

        return redirect('/index')->with('success','Profile successfuly deleted');
    }

    public function verify()
    {

        $user = Auth::user()->id;
        event(new Registered($user));

        return 12;
        //return view('auth.verify');


    }

    public function sendVerify($id)
    {
        $user = User::find($id);
        $email = $user->email;
      //  return $id;
        //{{url('/sendVerify/'.Auth::id())}}
        //$str='Patvirtinimo nuoroda: http://localhost/Ruddit/public/verifyEmail/'.$id;
        $str='Confirmation link: '.url('/receiveVerify/'.$id);

        $details=[
            'title'=>'Email confirmation',
            'body'=>$str,
            'subject'=>'Email confirmation'
        ];

        Mail::to($email)->send(new \App\Mail\VerifyMail($details));
        //return back()->with('response','Nuoroda iįsiųsta!');
        return redirect('/index')->with('success','Email has been sent!');
    }

    public function receiveVerify($id){
        $user = User::find($id);
        $user->el_pasto_patvirtinimas = 1;
        $user->save();
        return redirect('/index')->with('success','Email has been verified!');;
    }
}

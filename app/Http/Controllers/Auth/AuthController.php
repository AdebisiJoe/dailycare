<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\websitecontroller;
use App\Http\Controllers\AdminController;
use DB;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator


     */
    protected $username='username';
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            ]);
    }
    public function postLogin(Request $request){

       
     /*$credentials=[
    'email'=>$request->input('email'),
    'password'=>$request->input('password'),
    
     ];
     $true="true";

        //$email=$request->input('email');
      //$arole = DB::table('users')->where('email', $email)->value('role');
 if(Auth::check()){
    return redirect()->intended('/home');
 }else{
      if (!Auth::attempt($credentials)) {
         Session::flash('flash_error','something went wrong with your credentials');
         
         return redirect()->back();
      }
       elseif(Auth::attempt($credentials)){

     Session::flash('flash_message','you have logged in sucessfully');
      return redirect()->intended('/home');
     }
 }*/
      //elseif(Auth::attempt($credentials,$true)&& $arole=='Adminstrator'){

     // Session::flash('flash_message','you have logged in sucessfully');
     // return redirect()->intended('store/admin');
    // }
    // elseif (Auth::attempt($credentials,$true)&& $arole=='Cashier') {
 
      //Session::flash('flash_message','you have logged in sucessfully');
      //return redirect()->intended('store/user');
     //}
    // get our login input
 $login = $request->input('login');

    // check login field
 $login_type = filter_var( $login, FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';

    // merge our login field into the request with either email or username as key
 $request->merge([ $login_type => $login ]);

    // let's validate and set our credentials
 if ( $login_type == 'email' ) {

        //$this->validate($request, [
           // 'email'    => 'required|email',
           // 'password' => 'required',
        //]);

        //$credentials = $request->only( 'email', 'password' );
     Session::flash('flash_error','something went wrong with your credentials');
     
     return redirect()->back();

 } else {

    $this->validate($request, [
        'username' => 'required',
        'password' => 'required',
        ]);

    $credentials = $request->only( 'username', 'password' );

}

    /*if ($this->auth->attempt($credentials, $request->has('remember')))
    {
        //return redirect()->intended($this->redirectPath());
         return redirect()->intended('/home');
    }

    return redirect($this->loginPath())
        ->withInput($request->only('login', 'remember'))
        ->withErrors([
            'login' => $this->getFailedLoginMessage(),
            ]);*/

         $adminController=new AdminController();
         $username2=$request->username;
         if ($this->checkIfUserIsFraudAccountAndReturnBack($username2)){
               Session::flash('flash_danger','Your Account  has currently been deactivated please contact who you bought the pin from');
               return redirect()->back();
           }

           if ($adminController->checkIfUserIsBannedAndReturnBack($username2)){
               Session::flash('flash_danger','Your Account  has been banned please contact Administrator');
               return redirect()->back();
           }
            if (!Auth::attempt($credentials)) {
             Session::flash('flash_danger','something went wrong with your credentials');
             
             return redirect()->back();
         }
         elseif(Auth::attempt($credentials,$request->has('remember'))){

             Session::flash('flash_success','you have logged in sucessfully');

             $role=Auth::user()->role;
             if ($role=="admin") {
                 # code...
                $request->session()->put('openadmin',true);
                $request->session()->put('openshopadmin',true);
             } elseif ($role=="shopadmin") {
                 # code...
            $request->session()->put('openshopadmin',true);
             } 
             
             return redirect()->intended('/home');
         }


     }  



     public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('login');
    }

    public function checkIfUserIsFraudAccountAndReturnBack($username)
    {
    $bannedCount=DB::table('users')->where('username',$username)->where('fraud_banned',1)->count();

    if($bannedCount>0){

      return true;
    }

    return false;
    
   }  

    
}

/*
$username=Auth::user()->username;
         $member=DB::table('member_table')
                ->where('username',$username)
                ->first();
       if ($member==null) {
           # code...
       } else {
           # code...
    $membershipid=$member->membershipid;

      $stage = (new websitecontroller)->fillmatrix2($membershipid);
       }*/
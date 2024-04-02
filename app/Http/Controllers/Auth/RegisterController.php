<?php


namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {

         $validated = $request->validate([
             'email' =>['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => 'required|min:8|',
             'phone' =>'required',
             'name' =>'required',
         ]);
         if($validated){
            $user = new User();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->save();
            auth()->attempt(['email' => $request->email, 'password' => $request->password]);
            $user->sendEmailVerificationNotification();
            session()->flash("success", "Profile created successfully .");
             return redirect()->intended(route('admin.dashboard'));
         }
         else{
            return redirect()->back()->withInput();
         }

    }
}

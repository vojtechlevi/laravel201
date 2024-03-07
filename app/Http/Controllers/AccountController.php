<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function accesAccount()
    {
        // Retrieve the user object from the session
        $user = session('user');
        //$user = Auth::user();//testing

        // Access user properties
        $userID = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;

        return view('account', ['user' => $user, 'user_id' => $userID, 'user_name' => $userName, 'user_email' => $userEmail]);
    }

    public function updateAccount(Request $request)
    {


        $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'nullable|string|min:8',
        ]);


        //$user = Auth::user();
        $user = session('user');

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();


        return redirect('dashboard')->with('success', 'Account settings updated successfully.');
    }


    public function removeAccount(Request $request)
    {
        $user = session('user'); //deactivated for testing
        //$user = Auth::user();
        $userId = $request->input('id');
        $userDB = User::find($userId);//get the row from the DB to be deleted


        //if there is a row in the user table with the same id then delete it.
        if ($userDB) {
            // delete the user
            $userDB->delete();
            
            Auth::logout();
            Session::flash('success', 'Your account has been successfully removed.');

            // redirect to the login page
            return redirect('/');
        } else {
            Session::flash('error', 'Unable to remove account. Please try again.');


            return redirect('/')->with('Try again');
        }
    }
}

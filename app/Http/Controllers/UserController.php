<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
* Write code on Method
*
* @return response()
*/
    public function dashboard(Request $request)
    {
        return view('dashboard');
    }
    /**
    * Write code on Method
    *
    * @return response()
    */
    public function users(Request $request)
        {
        $users = User::get();
        return view('users', compact('users'));
    }
}

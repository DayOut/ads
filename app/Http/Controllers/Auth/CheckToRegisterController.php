<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 23.11.2017
 * Time: 18:00
 */

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class CheckToRegisterController extends Controller
{
    public function __construct()
    {
        $user = User::findOrNew($id)->fill(['name' => 'Vasya Pupkin'])->save();
        $this->middleware('guest');
    }

}
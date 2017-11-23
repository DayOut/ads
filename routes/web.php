<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Http\Request;
use App\Ad;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {

    $adverts = Ad::orderBy('created_at', 'desc')->paginate(5);

    return view('home', [
        'adverts' => $adverts,
    ]);
});

Auth::routes();

//Route::get('/', 'HomeController@index');
Route::get('/home', function () {
    return redirect('/');
});

//Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::get('auth/register', function () {
    return view('auth/register');
});

Route::post('/add_advert', function (Request $request) {
    //dump($request->all());

    $validator = Validator::make($request->all(), [
        'advert_title' => 'required|max:255',
        'advert_desc' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withInput()
            ->withErrors($validator);
    }

    $advert = new Ad;
    $user = Auth::user()->id;
    $userName = Auth::user()->name;
    $advert->title = $request->advert_title;
    $advert->description = $request->advert_desc;
    $advert->author_id = $user;
    $advert->author_name = $userName;
    $advert->save();

    return redirect()->back();
});

/**
 * Delete Task
 */
Route::delete('/delete/{id}', function ($id) {
    Ad::findOrFail($id)->delete();

    return redirect('/');
});
<?php

use Illuminate\Http\Request;
use App\Ad;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::group(['middleware' => ['web']], function () {
    /**
     * Go to index page with displaying all adverts
     */
    Route::get('/', function () {

        $adverts = Ad::orderBy('created_at', 'desc')->paginate(5);

        return view('home', [
            'adverts' => $adverts,
        ]);
    });

    /**
     * Go to index page
     */
    Route::get('/home', function () {
        return redirect('/');
    });

    /**
     * Go to page with register
     */
    Route::get('auth/register', function () {
        return view('auth/register');
    });

    /**
     * View advertise
     */
    Route::get('/{id}', function ($id) {


        return view('view_ad', [
            'advert' => Ad::where('id', $id)->get(),

        ]);
    })->where('id', '[0-9]+');

    /**
     * View advertise
     */
    Route::get('/{id}', function ($id) {

        return view('view_ad', [
            'advert' => Ad::where('id', $id)->get(),

        ]);
    })->where('id', '[0-9]+');
});


Route::group(['middleware' => 'auth'], function () {

    /**
     * Create advertise
     */
    Route::get('/edit', function () {

        $advert = array(new Ad);
        $advert[0]->title = "";
        $advert[0]->description = "";
        return view('edit', [
            'advert' => $advert,
        ]);
    });

    /**
     * Edit advertise
     */
    Route::get('/edit/{id}', function ($id) {


        return view('edit', [
            'advert' => Ad::where('id', $id)->get(),
        ]);
    })->where('id', '[0-9]+');

    /**
     * Delete advertise
     */
    Route::delete('/delete/{id}', function ($id) {

        Ad::findOrFail($id)->delete();

        return redirect('/');
    })->where('id', '[0-9]+');;

    /**
     * Write advertise to database
     */
    Route::post('/edit', function (Request $request) {

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
        return redirect('/' . $advert->id);
    });
});














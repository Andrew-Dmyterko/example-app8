<?php

use Illuminate\Support\Facades\Route;

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
// основной шаблон welcome
//Route::get('/', function () {
//    return view('welcome');
//});

// основной шаблон поменяли на свой home
Route::get('/', function () {
    return view('home');
})->name('home');

// добавили шаблон about
Route::get('/about', function () {
    return view('about');
})->name('about');

// добавили шаблон contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

//Auth::routes();

Route::get(
    '/contact/all/{id}',
    'ContactController@showOneMessage'
)->name('contact-data-one');

Route::get(
    '/contact/all/{id}/update',
    'ContactController@updateMessage'
)->name('contact-update');

Route::get(
    '/contact/all/{id}/delete',
    'ContactController@deleteMessage'
)->name('contact-delete');

Route::post(
    '/contact/all/{id}/update',
    'ContactController@updateMessageSubmit'
)->name('contact-update-submit');

Route::get('/contact/all', 'ContactController@allData')->name('contact-data');

Route::post('/contact/submit', 'ContactController@submit'
//    dd(Request::all());
//    return Request::all();
)->name('contact-form');

//-------------------------------------------

Route::get('/packageTrack', 'PackageController@packageTrack')->name('packageTrack');

//-------------------------------------------
Route::group(['middleware' => ['role:admin']], function () {
//    Route::get('/admin', function () {
//        return view('admin');
//    })->middleware('auth')->name('admin');

    Route::any('/admin/addoper', 'AdminController@addoper')
        ->name('addoper');

    Route::any('/admin/gopackage', 'AdminController@adminGoPackage')
        ->name('adminGoPackage');

    Route::any('/admin', 'AdminController@viewAdmin')
        ->middleware('auth')->name('admin');

});

Route::group(['middleware' => ['role:manager']], function () {
    Route::get('/manager', 'ManagerController@viewDesktop')
//        return view('oper');
        ->middleware('auth')->name('manager');

    Route::get('/manager/send/views', 'ManagerController@packageSendView')
//        return view('oper');
        ->middleware('auth')->name('managerSendView');

    Route::get('/manager/recive/views', 'ManagerController@managerToReciveViews')
//        return view('oper');
        ->middleware('auth')->name('managerToReciveViews');

    Route::get('/manager/recive/do', 'ManagerController@packageToRecive')
        ->middleware('auth')->name('managerToRecive');

    Route::get('/manager/send', 'ManagerController@packageSend')
//        return view('oper');
        ->middleware('auth')->name('managerSend');

    Route::get('/manager/bad', 'ManagerController@packageBad')
//        return view('oper');
        ->middleware('auth')->name('managerBadPackage');

//    Route::get('/oper/send', 'OperController@sendPackage')
////        return view('oper');
//        ->middleware('auth')->name('operSend');

});

Route::group(['middleware' => ['role:sklad']], function () {
    Route::get('/sklad', 'SkladController@viewDesktop')
//        return view('oper');
        ->middleware('auth')->name('sklad');

    Route::get('/sklad/pack/view', 'SkladController@packagePackView')
//        return view('oper');
        ->middleware('auth')->name('skladPackView');

    Route::get('/sklad/pack', 'SkladController@packagePack')
//        return view('oper');
        ->middleware('auth')->name('skladPack');

    Route::get('/sklad/recive', 'SkladController@packageReciveView')
//        return view('oper');
        ->middleware('auth')->name('skladPackReciveView');

    Route::get('/sklad/recive/do', 'SkladController@packageRecive')
//        return view('oper');
        ->middleware('auth')->name('skladPackRecive');

});

Route::group(['middleware' => ['role:operator']], function () {
    Route::get('/oper', 'OperController@viewDesktop')
//        return view('oper');
    ->middleware('auth')->name('oper');

    Route::get('/oper/send', 'OperController@sendPackage')
//        return view('oper');
    ->middleware('auth')->name('operSend');

    Route::get('/oper/recive', 'OperController@recivePackage')
//        return view('oper');
    ->middleware('auth')->name('operRecive');

    Route::get('/oper/recive/do/', 'OperController@recivePackageDo')
//        return view('oper');
        ->middleware('auth')->name('operReciveDo');

    Route::get('/oper/addnewexpress', 'OperController@addNewExpressUser')
//        return view('oper');
    ->middleware('auth')->name('add_new_express_user');

});

Route::get('/login', function () {
        return view('auth.login');
})->name('login');

Route::get('/reg', function () {
    return view('auth.register');
})->name('reg');

//Route::get('/admin', function () {
//    return view('admin');
//})->middleware('auth')->name('admin');

Route::get('/user.logout', function () {
    Session::flush();
    Auth::logout();
//    return Redirect::back();
    return redirect(route('home'));
})->name('logoutMy');

//Route::get('/back', function () {
//    return Redirect::back();
////    return redirect(route('home'));
//})->name('back');

// админ
// добавили шаблон admin
//Route::get('/admin', function () {
//    return view('admin');
//})->name('admin');

//Route::name('user.')->group(function() {
//    Route::view('/admin', 'admin')->middleware('auth')->name('adnin');
//
//    Route::get('login', function (){
//        if(Auth::check()){
//            return  redirect(route('admin'));
//        }
//        return view('login');
//    })->name('login');

//    Route::post('/login, [])

//    Route::get('/logout', [])->name('logout');

//    Route::get('/registration', function (){
//        if(Auth::check()){
//            return  redirect(route('admin'));
//        }
//        return view('registration');
//    })->name('registration');

//    Route::post('/registration',[]);
//});
//-------------------------------------------

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('foo', function() {
    return "Hello World!!!";
});

Route::get('hello', 'HelloController@index');

Route::get('ID/{id}/{num}',function($id, $num){
    echo 'ID: '.$id."  $num";
});

Route::get('IDD/{id?}/{num?}',function($id=1, $num=3){
    echo 'ID: '.$id."  $num";
});

Route::match(['get', 'post'],'I/{id?}/{num?}',function($id=1, $num=3){
    echo 'ID: '.$id."  $num";
});

Route::any('A/{id?}/{num?}',function($id=1, $num=3){
    echo 'ID: '.$id."  $num";
});

//Route::get('user/{id}', 'UserController@show');

//use App\Http\Controllers\HelloController;
//Route::get('hello', [HelloController::class,'index']);

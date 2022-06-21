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
Auth::routes(['verify' => true]);

Route::get('/organizations5', 'OrganizationController@index5')->name('organizations5');
Route::get('/organizations', 'OrganizationController@index')->name('organizations');
Route::get('/orgrepublic', 'OrganizationController@republic')->name('republic');
Route::get('/orgbishkek', 'OrganizationController@bishkek')->name('bishkek');
Route::get('/orgosh', 'OrganizationController@osh')->name('osh');
Route::get('/orgoblast', 'OrganizationController@oblast')->name('oblast');
Route::get('/oshoblast', 'OrganizationController@oshoblast')->name('oshoblast');
Route::get('/batkenoblast', 'OrganizationController@batkenoblast')->name('batkenoblast');
Route::get('/chuioblast', 'OrganizationController@chuioblast')->name('chuioblast');
Route::get('/narynoblast', 'OrganizationController@narynoblast')->name('narynoblast');
Route::get('/issykoblast', 'OrganizationController@issykoblast')->name('issykoblast');
Route::get('/djalaloblast', 'OrganizationController@djalaloblast')->name('djalaloblast');
Route::get('/talasoblast', 'OrganizationController@talasoblast')->name('talasoblast');

Route::get('/mainlist', 'OrganizationController@mainlist')->name('mainlist');
Route::get('/mainlist2', 'ApplicationController@mainlist2')->name('mainlist2');

Route::get('/forgot-password', 'UserController@forgotPassword')->name('forgot-password');
Route::get('/forgot-password/{token}',  'UserController@forgotPasswordValidate');
Route::post('/forgot-password2', 'UserController@resetPassword')->name('forgot-password2');
Route::put('/reset-password', 'UserController@updatePassword')->name('reset-password');


Route::get('/orgrepublic2', 'ApplicationController@republic')->name('republic2');
Route::get('/orgbishkek2', 'ApplicationController@bishkek')->name('bishkek2');
Route::get('/orgosh2', 'ApplicationController@osh')->name('osh2');
Route::get('/orgoblast2', 'ApplicationController@oblast')->name('oblast2');
Route::get('/oshoblast2', 'ApplicationController@oshoblast')->name('oshoblast2');
Route::get('/batkenoblast2', 'ApplicationController@batkenoblast')->name('batkenoblast2');
Route::get('/chuioblast2', 'ApplicationController@chuioblast')->name('chuioblast2');
Route::get('/narynoblast2', 'ApplicationController@narynoblast')->name('narynoblast2');
Route::get('/issykoblast2', 'ApplicationController@issykoblast')->name('issykoblast2');
Route::get('/djalaloblast2', 'ApplicationController@djalaloblast')->name('djalaloblast2');
Route::get('/talasoblast2', 'ApplicationController@talasoblast')->name('talasoblast2');



Route::get('/live_search/staff', 'OrganizationController@action')->name('live_search.staff');
Route::get('/application', 'ApplicationController@index')->name('application');
Route::get('/application2', 'ApplicationController@index5')->name('application2');
Route::get('/live_search/appaction', 'ApplicationController@action')->name('live_search.appaction');
Route::get('/', 'MainController@index')->name('mainlogin');

Route::get('/entry', 'Auth\LoginController@getLogin')->name('auth.get.login');
Route::get('/login', 'Auth\LoginController@getLogin')->name('auth.get.login');
Route::post('/login', 'Auth\LoginController@postLogin')->name('auth.post.login');

Route::get('/register', 'Auth\RegisterController@getRegister')->name('auth.get.register');
Route::post('/postregister', 'Auth\RegisterController@postRegister')->name('postregister');
Route::get('/registerajax', 'Auth\RegisterController@registerajax')->name('registerajax');

Route::get('/start', 'MainController@index')->name('mainlogin');
Route::get('/study', 'ApplicationController@study')->name('study');
Route::get('/retraine', 'ApplicationController@retraine')->name('retraine');


Route::post('/applicstore', 'ApplicantController@store')->name('applicant.store');

Route::get('/sayYes/{user_id}/{post_id}', 'NotemessageController@sayYes')->name('sayYes')->middleware('auth');
Route::get('/sayNo/{user_id}/{post_id}', 'NotemessageController@sayNo')->name('sayNo')->middleware('auth');

Route::get('/attestate/{user_id}', 'NotemessageController@attestate')->name('attestate')->middleware('auth');
Route::get('/retraining/{user_id}', 'NotemessageController@retraine')->name('retraining')->middleware('auth');

Route::get('/applicant', 'ApplicantController@index')->name('main')->middleware('auth');
Route::get('/successaction/{user_id}', 'ApplicantController@saction')->name('successaction')->middleware('auth');
Route::get('/sendaction/{user_id}', 'ApplicantController@sendaction')->name('sendaction')->middleware('auth');
Route::get('/search', 'ApplicantController@search')->name('search');
Route::post('/apprestore/{post_id}', 'ApplicantController@restore')->name('applicant.restore')->middleware('auth');

Route::get('/showapfor/{user_id}', 'ApplicantController@showapfor')->name('showapfor')->middleware('auth');
Route::get('/ruccessaction/{post_id}', 'ApplicantController@raction')->name('ruccessaction')->middleware('auth');
Route::get('/tuccessaction/{post_id}', 'ApplicantController@taction')->name('tuccessaction')->middleware('auth');

Route::get('/notesaction/{user_id}/{post_id}', 'ContestController@saction')->name('notesaction')->middleware('auth');

Route::get('/createeducation/{user_id}', 'EducationController@create')->name('createeducation')->middleware('auth');

Route::get('/app/{id}/edit', 'ApplicationController@update23')->name('app.update');
Route::post('/appup/{post_id}', 'ApplicationController@store23')->name('appup.edit');

Route::get('/edu/{id}/edit', 'EducationController@update')->name('edu.update');
Route::post('/edu/{id}', 'EducationController@edit')->name('edu.edit');

Route::get('/formation/{id}/edit', 'FormationController@update')->name('formation.update');
Route::post('/formation/{id}', 'FormationController@edit')->name('formation.edit');

Route::get('/experience/{id}/edit', 'ExperienceController@update')->name('experience.update');
Route::post('/experience/{id}', 'ExperienceController@edit')->name('experience.edit');

Route::get('/extra/{id}/edit', 'ExtraController@update')->name('extra.update');
Route::post('/extra/{id}', 'ExtraController@edit')->name('extra.edit');

Route::post('/storeeducation', 'EducationController@store')->name('storeeducation')->middleware('auth');
Route::get('/ajaxproduction/{user_id}', 'EducationController@ajaxproduction')->name('ajaxproduction')->middleware('auth');
Route::get('/kindeducation/{id}', 'EducationController@kindeducation')->name('kindeducation');
Route::get('/kindeducation3/{id}', 'EducationController@kindeducation3')->name('kindeducation3');
Route::get('/deleteproduction/{post_id}', 'EducationController@delete')->name('deleteproduction')->middleware('auth');

Route::get('/createformation/{user_id}', 'FormationController@create')->name('createformation')->middleware('auth');
Route::post('/storeformation', 'FormationController@store')->name('storeformation')->middleware('auth');
Route::get('/ajaxproductionfor/{user_id}', 'FormationController@ajaxproduction')->name('ajaxproductionfor')->middleware('auth');
Route::get('/kindeducationfor/{id}', 'FormationController@kindeducation')->name('kindeducationfor');
Route::get('/deleteformation/{post_id}', 'FormationController@delete')->name('deleteformation')->middleware('auth');


Route::get('/createexperience/{user_id}', 'ExperienceController@create')->name('createexperience')->middleware('auth');
Route::post('/storeexperience', 'ExperienceController@store')->name('storeexperience')->middleware('auth');
Route::get('/ajaxproduction2/{user_id}', 'ExperienceController@ajaxproduction')->name('ajaxproduction2')->middleware('auth');
Route::get('/deleteproduction2/{post_id}', 'ExperienceController@delete')->name('deleteproduction2')->middleware('auth');

Route::get('/createattestation/{user_id}', 'AttestationController@create')->name('createattestation');
Route::post('/storeattestation', 'AttestationController@store')->name('storeattestation');
Route::get('/ajaxproduction3/{user_id}', 'AttestationController@ajaxproduction')->name('ajaxproduction3');
Route::get('/deleteproduction3/{post_id}', 'AttestationController@delete')->name('deleteproduction3');

Route::get('/createextra/{user_id}', 'ExtraController@create')->name('createextra')->middleware('auth');
Route::post('/storeextra', 'ExtraController@store')->name('storeextra')->middleware('auth');
Route::get('/ajaxproduction4/{user_id}', 'ExtraController@ajaxproduction')->name('ajaxproduction4')->middleware('auth');
Route::get('/deleteproduction4/{post_id}', 'ExtraController@delete')->name('deleteproduction4')->middleware('auth');

Route::get('/notifications/{user_id}', 'NotemessageController@index')->name('notifications')->middleware('auth');
Route::get('/attestation/{user_id}', 'NotemessageController@attestation')->name('attestation')->middleware('auth');
Route::get('/transaction/{user_id}', 'NotemessageController@transaction')->name('transaction')->middleware('auth');
Route::get('/appcontest/{user_id}', 'NotemessageController@appcontest')->name('appcontest')->middleware('auth');
Route::get('/note/{post_id}', 'NotemessageController@show')->name('note')->middleware('auth');
Route::get('/note2/{post_id}', 'NotemessageController@show2')->name('note2')->middleware('auth');
Route::get('/note3/{post_id}', 'NotemessageController@show3')->name('note3')->middleware('auth');

Route::group(['prefix' => '/auth', 'middleware' =>  ['auth', 'verified']] ,function () {
    //you can create the list of the url or the resource here to block the unath users.
    Route::get('/createapplicant', 'ApplicantController@create')->name('createapplicant');
    Route::get('/appstore/{id}', 'ApplicantController@fraction')->name('appstore');
    Route::get('/appstore2/{id}', 'ApplicantController@braction')->name('appstore2');
    
    
    Route::get('/dashboard/{user_id}', 'IndexController@index')->name('dashboard');
    Route::get('/applicationinner', 'ApplicationController@appindex')->name('applicationinner');
    Route::get('/archive', 'ApplicationController@archive')->name('archive');
    Route::get('/applicationattestation', 'ApplicationController@appindexatt')->name('applicationattestation');
    Route::get('/applicationreserve', 'ApplicationController@reserve')->name('applicationreserve');
    Route::get('/restore/{post_id}', 'ApplicationController@restore')->name('apprestore');
    
    Route::get('/allusers', 'ApplicantController@allusers')->name('allusers');
    Route::get('/contestlist', 'ContestController@index')->name('contestlist');

    Route::get('/profile/{user_id}', 'UserController@index')->name('profile');
    Route::get('/educationuser/{user_id}', 'UserController@geteducation')->name('educationuser');
    Route::get('/experienceuser/{user_id}', 'UserController@getexperience')->name('attestationuser');
    Route::get('/attestationuser/{user_id}', 'UserController@getattestation')->name('experienceuser');
    Route::get('/formationuser/{user_id}', 'UserController@getformation')->name('formationuser');
    Route::get('/extrauser/{user_id}', 'UserController@getextra')->name('extrauser');
    
    Route::get('/restorereserve/{post_id}', 'ApplicationController@restorereserve')->name('restorereserve');
    Route::get('/offer', 'ApplicationController@offer')->name('offer');
    Route::post('/sendagreement/{post_id}', 'ApplicationController@sendagreement')->name('sendagreement');
    Route::get('/showagreement', 'ApplicationController@showagreement')->name('showagreement');
    
    Route::get('/color/{id}/edit', 'ApplicationController@update')->name('color.update');
    Route::post('/color/{id}', 'ApplicationController@edit')->name('color.edit');

    Route::get('/edu/{id}/edit', 'EducationController@update')->name('edu.update');
    Route::post('/edu/{id}', 'EducationController@edit')->name('edu.edit');


    Route::get('/applicant', 'ApplicantController@index')->name('main');
    Route::get('/download/{file}', 'ApplicantController@download')->name('download');
    Route::post('/conteststore', 'ContestController@store')->name('conteststore');
    Route::get('/showcontest/{id}', 'ContestController@show')->name('showcontest');
    Route::post('/notestore', 'NotificationlistController@store')->name('notestore');
    Route::get('/appointment', 'AppointmentController@index')->name('appointment');
    Route::get('/showappointment/{id}', 'AppointmentController@show')->name('showappointment');
    Route::post('/storeappointment', 'AppointmentController@store')->name('storeappointment');

    
    Route::get('/createapplication', 'ApplicationController@create')->name('createapplication');
    Route::get('/applistore/{id}', 'ApplicationController@fraction')->name('applistore');
    Route::post('/applicationstore', 'ApplicationController@store')->name('application.store');
    Route::get('/showap/{post_id}', 'ApplicationController@show')->name('showap');
    Route::get('/showap2/{post_id}', 'ApplicationController@show2')->name('showap2');
    
    Route::get('/showapp/{post_id}', 'ApplicantController@show')->name('showapp');
    Route::get('/showapp2/{post_id}', 'ApplicantController@show2')->name('showapp2');
    
    Route::post('/sendcon/{post_id}', 'ApplicationController@consider')->name('sendcon');
    Route::post('/approve/{post_id}', 'ApplicationController@approve')->name('approve');
    Route::post('/approveR/{post_id}', 'ApplicationController@approveR')->name('approveR');
    Route::post('/cancel/{post_id}', 'ApplicationController@cancel')->name('cancel');
    
    Route::post('/sendcon2/{post_id}', 'ApplicantController@consider')->name('sendcon2');
    Route::post('/approve2/{post_id}', 'ApplicantController@approve')->name('approve2');
    Route::post('/approve2R/{post_id}', 'ApplicantController@approveR')->name('approve2R');
    Route::post('/cancel2/{post_id}', 'ApplicantController@cancel')->name('cancel2');

    Route::post('/edit/{post_id}', 'ApplicantController@edit')->name('edit');

    Route::get('/mark', 'ApplicantController@mark')->name('mark');
    
    Route::get('/updatecontest/{user_id}', 'ApplicantController@updatecontest')->name('updatecontest');
    Route::get('/contest', 'ApplicantController@contest')->name('contest');
});



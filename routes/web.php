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

Route::get('/', function () {
    return view('public/index');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

//Frontend
Route::get('/getblogPost','BlogController@getAllBlogPost');
Route::get('/singlePost/{id}','BlogController@singlePostById');
Route::get('/categoryForSidebar','BlogController@categoryForSidebar');
Route::get('/latest','BlogController@latest');
Route::get('/allpostbyCategoryId/{id}','BlogController@allpostbyCategoryId');
Route::get('/search','BlogController@searchpost');



Route::group(['middleware' => ['auth']], function () {
    //admin
//    Route::get('/{anypath}','HomeController@index')->where('path','.*');
    //Category Related
    Route::post('/save-category','CategoryController@save_category');
    Route::get('/getCategories','CategoryController@getCategories');
    Route::get('/delete-categoryById/{id}','CategoryController@deleteCategoryById');
    Route::get('/edit-category/{id}','CategoryController@EditCategoryById');
    Route::post('/update-category/{id}','CategoryController@updateCategoryById');
    Route::get('/deletebyCheckbox/{id}','CategoryController@deletebyCheckbox');

//Post Related

    Route::get('/getPosts','PostController@getPosts');
    Route::post('/save-post','PostController@savePost');
    Route::get('/delete-PostById/{id}','PostController@deletePostById');
    Route::get('/edit-post/{id}','PostController@EditPostById');
    Route::post('/update-post/{id}','PostController@updatePost');
    Route::get('/deletPostBycheckbox/{id}','PostController@deletPostBycheckbox');


    //frontedn

});



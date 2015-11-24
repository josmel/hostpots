<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */



Route::group(['namespace' => 'Client', 'prefix' => 'admclient'], function () {
    Route::get('/', ['uses' => 'WelcomeController@index', 'as' => 'Welcomeclient']);
    Route::controllers([
        'perfil' => 'ProfileController',
        'profile-admin' => 'ProfileAdminController',
        'equipment' => 'EquipmentController',
        'campanias' => 'CampaniasController',
        'user' => 'UserController'
    ]);
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'WelcomeController@index');
     Route::get('login-user', 'LoginUserController@loginUser');
    Route::get('d0c', ['middleware' => 'auth.basic.once', function() {
            return view('home.doc.api');
        }]);
    Route::controllers([
        '/' => 'AuthController',
    ]);
});

Route::get('/roles', function() {
//    $admin = new App\Models\Role();
//    $admin->name         = 'admin';
//    $admin->display_name = 'User Administrator'; // optional
//    $admin->description  = 'User is the owner of a given project'; // optional
//    $admin->save();
//
//    $client = new App\Models\Role();
//    $client->name         = 'client';
//    $client->display_name = 'Client'; // optional
//    $client->description  = 'User is the client'; // optional
//    $client->save();
//    
//    $createPost = new App\Models\Permission();
//    $createPost->name         = 'create-post';
//    $createPost->display_name = 'Create Posts'; // optional
//    // Allow a user to...
//    $createPost->description  = 'create new blog posts'; // optional
//    $createPost->save();
//
//    $editUser = new App\Models\Permission();
//    $editUser->name         = 'edit-user';
//    $editUser->display_name = 'Edit Users'; // optional
//    // Allow a user to...
//    $editUser->description  = 'edit existing users'; // optional
//    $editUser->save();
//    
    $user = App\Models\User::where('email', '=', 'client@client.com')->first();
//    $client = App\Models\Role::where('name', '=', 'client')->first();
//    $user->attachRole($client);
//    
//    $createPost = App\Models\Permission::where('name','=','create-post')->first();
//    $editUser = App\Models\Permission::where('name','=','edit-user')->first();
//    $admin = App\Models\Role::where('name', '=', 'admin')->first();
//    $admin->attachPermissions(array($createPost, $editUser));
//    $client->attachPermission($createPost);

    var_dump($user->hasRole('admin'));   // false
    var_dump($user->hasRole('client'));   // true
    var_dump($user->can('edit-user'));   // false
    var_dump($user->can('create-post')); // true
    var_dump($user->hasRole(['client', 'admin'], true));       // true
    var_dump($user->can(['create-post', 'edit-user'])); // true

    echo 'done';
});

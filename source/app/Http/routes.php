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

Route::group(['namespace' => 'Wservice', 'prefix' => 'wservice'], function () {
    Route::resource('user', 'UserController');
    Route::post('driver/login', 'LoginDriverController@index');
    Route::get('delivery/{year}/{month}/{day}/{status_id?}/{complet?}/{customer_id?}', 'ServiceController@listServices');
    Route::get('delivery/price/{lat_1}/{lon_1}/{lat_2}/{lon_2}/{zone}/{calculate}', 'ServiceController@deliveryPrice');
    Route::get('delivery/detail/{idDelivery}','StateDeliveryController@getDetail');
    Route::get('state-delivery/list','StateDeliveryController@getList');
    Route::get('state-delivery/list-delivery-driver/{idDriver}','StateDeliveryController@getListDeliveryDriver');
    Route::post('state-delivery','StateDeliveryController@transitionStateDelivery');
    Route::post('state-driver','StateDriverController@changeStateDriver');
    Route::get('state-driver/{idDriver}','StateDriverController@getDetail');
     Route::get('state-delivery/testing','StateDeliveryController@getTesting');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admpanel'], function () {
    Route::get('/',['uses'=>'HomeController@index','as'=>'homeadmin']);
    Route::controllers([
            'auth' => 'AuthController',
//            'password' => 'Auth\PasswordController',
            'profile'=>'ProfileController',
         'customer'=>'CustomerController',
        'delivery'=>'DeliveryController',
        'driver'=>'DriverController',
    ]);
});

Route::group(['namespace' => 'Client', 'prefix' => 'admclient' ], function () {
    Route::get('/',['uses'=>'WelcomeController@index','as'=>'Welcomeclient']);
   // Route::get('activos','WelcomeController@activos');
//    Route::get('detalle-activos','WelcomeController@detalleActivos');
    Route::post('tarifa','WelcomeController@tarifa');
//    Route::get('completados','WelcomeController@completados');
//    Route::get('detalle-completados','WelcomeController@detalleCompletados');
    Route::get('analytics','WelcomeController@analytics');
    Route::get('soporte','WelcomeController@soporte');
    Route::get('solicitar/detalle-completados/{id}','RequestController@getDetalleActivos');
    Route::controllers([
            'perfil' => 'ProfileController',
            'solicitar' => 'RequestController',
            'client' => 'ClientController',
    ]);
});

Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'WelcomeController@index');
    Route::get('comunidad', 'WelcomeController@comunidad');
    Route::get('contactanos', 'WelcomeController@contactanos');
    Route::get('preguntas-frecuentes', 'WelcomeController@faq');
    Route::get('nosotros', 'WelcomeController@nosotros');
    Route::get('recuperar', 'WelcomeController@recuperar');
    Route::get('terminos', 'WelcomeController@terminos');
    Route::get('trabaja', 'WelcomeController@trabaja');
//    Route::get('unete', 'WelcomeController@unete');
//    Route::get('d0c', 'WelcomeController@api');
    Route::get('d0c', ['middleware' => 'auth.basic.once', function() {
        return view('home.doc.api');
    }]);
    Route::controllers([
            'registrate' => 'RegisterController',
            'unete' => 'RegisterDriverController',
            '/' => 'AuthController',
    ]);
});

Route::get('/roles', function(){
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
    var_dump($user->hasRole(['client', 'admin'],true));       // true
    var_dump($user->can(['create-post', 'edit-user'])); // true
    
    echo 'done';
});
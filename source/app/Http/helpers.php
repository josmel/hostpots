<?php


//namespace App\Http\Helper {
if (!function_exists('viewc')) {

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\View\View
     */
    function viewc($view = null, $data = array(), $mergeData = array()) { 
        $router = Route::getCurrentRoute()->getActionName();
        $module = substr($router, strripos($router, 'Controllers\\') + 12, (strrpos($router, '\\') - (strripos($router, 'Controllers\\') + 12)));
        $controller = substr($router, strripos($router, '\\') + 1, (strpos($router, 'Controller@')) - (strripos($router, '\\') + 1));
        $action = substr($router, strpos($router, '@') + 1);
        $route = ['module' => $module,
            'controller' => $controller,
            'action' => $action,
        ];
        $data = array_merge($data, $route);
        $factory = app('Illuminate\Contracts\View\Factory');
        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }

}



if (!function_exists('viewcMenu')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     */
    function viewcMenu() {
        $user = Auth::admin()->user();
        if($user){
        $controladoresTwo = array(
            array('name' => 'Home', 'controller' => 'Admin\HomeController@index'),
            array('name' => 'Administradores', 'controller' => 'Admin\AdminController@getIndex'),
            array('name' => 'Colaboradores', 'controller' => 'Admin\UserController@getIndex'),
            array('name' => 'Regiones', 'controller' => 'Admin\RegionController@getIndex'),
            array('name' => 'Promociones','controller' => 'Admin\PromotionController@getIndex'),
            array('name' => 'Perfil', 'controller' => 'Admin\ProfileController@getIndex'),
            array('name' => 'Tips', 'controller' => 'Admin\TipsController@getIndex'));
        foreach ($controladoresTwo as $key => $value) {
            if ($user->can($value['controller'])) {
                $valor[] = array('name' => $value['name'], 'controller' => $value['controller']);
            }
        }}
        return $valor;
    }

}



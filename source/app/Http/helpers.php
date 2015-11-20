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
        $user = Auth::customer()->user();
        if ($user) {
            if ($user->type == 1) {
                $controladoresTwo = array(   
                    array('name' => 'Pelfil ADmin', 'controller' => 'admclient\ProfileAdminController@getIndex'),
                    array('name' => 'Clientes', 'controller' => 'admclient\UserController@getIndex'));
            } else {
                $controladoresTwo = array(
                    array('name' => 'Mi Perfil', 'controller' => 'admclient/perfil'),
                    array('name' => 'Mis Campañas', 'controller' => 'admclient/campanias'),
                    array('name' => 'MIs Equipos', 'controller' => 'admclient/equipment'));
            }
            foreach ($controladoresTwo as $key => $value) {
                $valor[] = array('name' => $value['name'], 'controller' => $value['controller']);
            }
        }
        return $valor;
    }

}



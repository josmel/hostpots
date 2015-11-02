<?php namespace App\Http\Middleware;


class Ajax extends BaseVerifier
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        // Looks for the value of request parameter called "ajax"
        // to determine controller's method call
        if ($request->ajax()) {
            $routeAction = $request->route()->getAction();
            $ajaxValue = studly_case($request->input("ajax"));
            $routeAction['uses'] = str_replace("@index", "@ajax".$ajaxValue, $routeAction['uses']);
            $routeAction['controller'] = str_replace("@index", "@ajax".$ajaxValue, $routeAction['controller']);
            $request->route()->setAction($routeAction);
        }

        return $next($request);
    }
    
//Route::any('some/page/', ['as' => 'some-page', 'middleware'=>'ajax', 'uses' => 'SomePageController@index']);
    
//<?php namespace App\Http\Controllers;
//
//class SomePageController extends Controller {
//
//    public function index()
//    {
//        return view('some.page.index');
//    }
//
//    public function ajaxMyAction(Requests\SomeFormRequest $request){
//        die('Do my action here!');
//    }
//
//    public function ajaxMyOtherAction(Requests\SomeFormRequest $request){
//        die('Do my other action here!');
//    }

}

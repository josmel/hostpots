<?php namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('client.welcome.index');
	}
//	public function activos()
//	{
//		return view('client.activos.index');
//	}
	public function tarifa()
	{
		return array('state'=> 1, 'msg' => 'ok', 'data'=> array('price'=>  \rand(11, 999)));
	}
//	public function detalleActivos()
//	{
//		return view('client.activos.detalle');
//	}
//	public function completados()
//	{
//		return view('client.completados.index');
//	}
//	public function detalleCompletados()
//	{
//		return view('client.completados.detalle');
//	}
//	public function perfil()
//	{
//		return view('client.perfil.index');
//	}
	public function analytics()
	{
		return view('client.analytics.index');
	}
	public function soporte()
	{
		return view('client.soporte.index');
	}

}

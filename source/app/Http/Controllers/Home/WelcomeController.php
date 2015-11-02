<?php namespace App\Http\Controllers\Home;

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
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home.welcome.index');
	}
	public function comunidad()
	{
		return view('home.comunidad.index');
	}
	public function contactanos()
	{
		return view('home.contactanos.index');
	}
	public function faq()
	{
		return view('home.faq.index');
	}
	public function login()
	{
		return view('home.login.index');
	}
	public function nosotros()
	{
		return view('home.nosotros.index');
	}
	public function recuperar()
	{
		return view('home.recuperar.index');
	}
	public function registrate()
	{
		return view('home.registrate.index');
	}
	public function terminos()
	{
		return view('home.terminos.index');
	}
	public function trabaja()
	{
		return view('home.trabaja.index');
	}
//	public function unete()
//	{
//		return view('home.unete.index');
//	}
	public function api()
	{
		return view('home.doc.api');
	}	

}

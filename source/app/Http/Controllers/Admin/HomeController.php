<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
class HomeController extends Controller {

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function __construct() {
        $this->middleware('authadmin');
    }

    public function index() {
        return /* \App\Http\Helper\ */viewc('admin.home.index');
    }

}

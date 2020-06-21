<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApiController extends Controller
{
    //
    use ApiResponser;

    public function __construct(){
    	// $this->middleware('auth:api');
    }

    protected function allowAdminActions() {
    	//check admin authorization
        if(Gate::denies('admin-action')) {
            throw new AuthorizationException("This action is unauthorized");   
        };
    }
}



<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function index()
    {
        if (!isset(auth()->user()->role)) {
            return redirect('/');
        } elseif (auth()->user()->role == 'admin') {
            return redirect('/admin/products');
        } elseif (auth()->user()->role == 'user') {
            return redirect('/');
        } else{
            return auth()->logout();
        }
    }
}

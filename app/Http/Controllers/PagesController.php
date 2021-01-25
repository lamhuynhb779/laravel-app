<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller {

    public function getUsers($name = null) {
        if (empty($name)) {
            $listUsers = DB::select('call fetch_all_users()');
        } else {
            $listUsers = DB::select('call fetch_users_with_name("' . $name . '")');
        }

        return view('pages/get_users', [
            'list_users' => $listUsers,
        ]);
    }

    public function home() {
        return view('pages/home');
    }

}
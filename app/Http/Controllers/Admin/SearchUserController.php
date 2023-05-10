<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchUserController extends Controller
{
    public function searchUser(Request $request)
    {
        $keyword = $request->search;
        $users = User::where('name' , 'LIKE' , '%'.$keyword.'%')->paginate(3);

        return view('admin.users.index', compact('users'));
    }
}

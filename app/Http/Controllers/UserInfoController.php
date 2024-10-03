<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Call;
use App\Models\Table;
use App\Models\Customer;

class UserInfoController extends Controller
{
    public function getUserInfo(Request $request)
    {
        $id = $request->input('id');
        $email = $request->input('email');
        $phone = $request->input('phone');

        $userQuery = User::query();
        if ($id) {
            $userQuery->where('id', $id);
        }
        if ($email) {
            $userQuery->where('email', $email);
        }
        if ($phone) {
            $userQuery->where('phone', $phone);
        }

        $user = $userQuery->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $userInfo = $user->toArray();

        $calls = Call::where('called_no', $userInfo['phone'])->get();

        $tables = Table::where('created_by', $userInfo['id'])->get();

        $response = [
            'user' => $userInfo,
            'calls' => $calls,
            'tables' => $tables
        ];

        return response()->json($response);
    }



    public function index()
    {
        return view('content.apps.app-user-list');
    }

    public function customersindex()
    {
        return view('content.apps.app-customer-list');
    }

    public function users()
    {
        $users = User::all(); 
        return response()->json( ['data' => $users]);
    }

    public function getcustomers()
    {
        $users = Customer::all(); 
        return response()->json( ['data' => $users]);
    }

}

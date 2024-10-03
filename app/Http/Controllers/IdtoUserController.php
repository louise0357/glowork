<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;

class IdtoUserController extends Controller
{
    public function getUsername($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['username' => $user->username]);
        } else if (!$user) {
            $customer = Customer::find($id);
            return response()->json(['username' => $user->username]);

        }

        return response()->json(['username' => 'Unknown User']);
    }
}

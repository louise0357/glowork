<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:customers',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:50',
            'state' => 'nullable|string|max:50',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'customer_status' => 'required|in:aktif,pasif,beklemede',
        ]);

        $customer = new Customer($request->all());
        $customer->save();

        return redirect('/customers/create')->with('message', 'Customer created successfully');
    }
    public function check(Request $request)
    {
        $rules = [
            'key' => 'required|string',
            'phone_number' => 'required|string'
        ];

        $messages = [
            'key.required' => 'Lütfen API anahtarını giriniz.',
            'key.string' => 'API anahtarı geçerli bir string olmalıdır.',
            'phone_number.required' => 'Lütfen telefon numarasını giriniz.',
            'phone_number.string' => 'Telefon numarası geçerli bir string olmalıdır.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$request->has('key') || empty($request->input('key'))) {
            return response()->json(['message' => 'Lütfen API anahtarını giriniz.'], 404);
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validatedData = $validator->validated();

        $user = User::where('api_key', $validatedData['key'])->first();

        if (!$user) {
            return response()->json(['message' => 'Geçersiz API anahtarı'], 401);
        }

        $exists = Customer::where('phone_number', $validatedData['phone_number'])->exists();

        return response()->json(['match' => $exists]);
    }
    
}

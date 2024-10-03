<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CallAddApi extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'key' => 'string',
            'caller_no' => 'string',
            'called_no' => 'string',
            'isresponded' => 'integer',
            'call_start_time' => 'string',
            'call_end_time' => 'string',
            'call_duration' => 'string',
            'call_summary' => 'string',
            'call_type' => 'string'
        ];

        $messages = [

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if (!$request->has('key') || empty($request->input('key'))) {
            return response()->json(['message' => 'Please enter the API key.'], 404);
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validatedData = $validator->validated();

        $user = User::where('api_key', $validatedData['key'])->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid API key'], 401);
        }

        $call = new Call();
        $call->caller_no = $validatedData['caller_no'];
        $call->called_no = $validatedData['called_no'];
        $call->isresponded = $validatedData['isresponded'];
        $call->call_start_time = $validatedData['call_start_time'];
        $call->call_end_time = $validatedData['call_end_time'];
        $call->call_duration = $validatedData['call_duration'];
        $call->call_summary = $validatedData['call_summary'];
        $call->call_type = $validatedData['call_type'];

        $call->representative_id = $user->id;

        $call->save();

        return response()->json(['message' => 'Data added succesfully', 'data' => $call], 201);
    }
}

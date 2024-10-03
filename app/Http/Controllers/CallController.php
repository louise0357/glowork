<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;

class CallController extends Controller
{


    public function index()
    {
        if (!auth()->user()->hasAnyRole(['calls_yetkilisi', 'admin'])) {
            return response()->json(['success' => false, 'message' => 'Bu işlemi yapmak için yetkiniz yok.'], 403);
        }
        $calls = Call::all();
        return view('content.calls.index', compact('calls'));
    }

    public function getCalls()
    {
        if (!auth()->user()->hasAnyRole(['calls_yetkilisi', 'admin'])) {
            return response()->json(['success' => false, 'message' => 'Bu işlemi yapmak için yetkiniz yok.'], 403);
        }

        $calls = Call::all();

        $callsData = $calls->map(function ($call) {
            $caller = Customer::where('phone_number', $call->caller_no)->first();
            $called = User::where('phone', $call->called_no)->first();

            return [
                'call_id' => $call->call_id,
                'caller_no' => $call->caller_no,
                'caller_name' => $caller ? $caller->full_name : 'Müşteri sistemde kayıtlı değildir.',
                'called_no' => $call->called_no,
                'called_name' => $called ? $called->name : 'Personel numarası sistemde kayıtlı değildir.',
                'representative_id' => $call->representative_id,
                'isresponded' => $call->isresponded,
                'call_start_time' => $call->call_start_time,
                'call_end_time' => $call->call_end_time,
                'call_duration' => $call->call_duration,
                'call_type' => $call->call_type,
                'call_reason' => $call->call_reason,
                'call_summary' => $call->call_summary,
                'call_notes' => $call->call_notes,
                'personel_evaluation' => $call->personel_evaluation,
                'resolution_status' => $call->resolution_status,
                'related_calls' => $call->related_calls
            ];
        });

        return response()->json(['data' => $callsData]);
    }


    public function updateCallContent(Request $request)
    {
        if (!auth()->user()->hasAnyRole(['calls_yetkilisi', 'admin'])) {
            return response()->json(['success' => false, 'message' => 'Bu işlemi yapmak için yetkiniz yok.'], 403);
        }

        $validatedData = $request->validate([
            'call_id' => 'required|integer',
            'caller_no' => 'required|string',
            'caller_name' => 'required|string',
            'called_no' => 'required|string',
            'called_name' => 'required|string',
            'representative_id' => 'required|string',
            'call_start_time' => 'required|date_format:Y-m-d H:i:s',
            'call_end_time' => 'required|date_format:Y-m-d H:i:s',
            'call_duration' => 'required|string',
            'call_type' => 'required|string',
            'call_reason' => 'required|string',
            'call_notes' => 'nullable|string',
            'personel_evaluation' => 'nullable|string',
            'resolution_status' => 'required|string',
        ]);

        $call = Call::find($validatedData['call_id']);
        $call->update($validatedData);

        return response()->json(['success' => true]);
    }


    public function addNewRecord(Request $request)
    {
        if (!auth()->user()->hasAnyRole(['calls_yetkilisi', 'admin'])) {
            return response()->json(['success' => false, 'message' => 'Bu işlemi yapmak için yetkiniz yok.'], 403);
        }

        $validatedData = $request->validate([
            'caller_no' => 'required|string',
            'called_no' => 'required|string',
            'representative_id' => 'required|string',
            'call_start_time' => 'required|date_format:Y-m-d H:i:s',
            'call_end_time' => 'required|date_format:Y-m-d H:i:s',
            'call_duration' => 'required|string',
            'call_type' => 'required|string',
            'call_reason' => 'required|string',
            'call_notes' => 'nullable|string',
            'personel_evaluation' => 'nullable|string',
            'resolution_status' => 'required|string',
        ]);

        $call = new Call();
        $call->caller_no = $validatedData['caller_no'];
        $call->called_no = $validatedData['called_no'];
        $call->representative_id = $validatedData['representative_id'];
        $call->call_start_time = $validatedData['call_start_time'];
        $call->call_end_time = $validatedData['call_end_time'];
        $call->call_duration = $validatedData['call_duration'];
        $call->call_type = $validatedData['call_type'];
        $call->call_reason = $validatedData['call_reason'];
        $call->call_notes = $validatedData['call_notes'];
        $call->personel_evaluation = $validatedData['personel_evaluation'];
        $call->resolution_status = $validatedData['resolution_status'];

        $call->save();

        return response()->json(['success' => true]);
    }



    public function create()
    {
        return view('content.calls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'caller_no' => 'required',
            'called_no' => 'required',
            'representative_id' => 'required',
            'call_start_time' => 'required|date',
            'call_end_time' => 'required|date',
            'call_duration' => 'required',
            'call_type' => 'required',
            'call_reason' => 'nullable',
            'call_notes' => 'nullable',
            'resolution_status' => 'required',
            'related_calls' => 'nullable|array',
            'related_calls.*' => 'integer',
        ]);

        Call::create($request->all());

        return redirect()->route('content.calls.index')->with('success', 'Call created successfully.');
    }



    public function edit(Call $call)
    {
        return view('content.calls.edit', compact('call'));
    }

    public function update(Request $request, Call $call)
    {
        $request->validate([
            'caller_id' => 'required',
            'representative_id' => 'required',
            'call_start_time' => 'required|date',
            'call_end_time' => 'required|date',
            'call_duration' => 'required',
            'call_type' => 'required',
            'call_reason' => 'nullable',
            'call_notes' => 'nullable',
            'resolution_status' => 'required',
            'related_calls' => 'nullable|array',
            'related_calls.*' => 'integer',
        ]);

        $call->update($request->all());

        return redirect()->route('content.calls.index')->with('success', 'Call updated successfully.');
    }



    public function fetchCallDetails(Request $request)
    {
        $callIds = $request->input('call_ids');

        if (empty($callIds)) {
            return response()->json(['success' => false, 'message' => 'Arama ID\'leri bulunamadı.']);
        }

        $callDetails = Call::whereIn('call_id', $callIds)->get(['call_id', 'caller_no', 'called_no', 'call_start_time', 'call_end_time', 'call_duration', 'call_summary', 'resolution_status']);

        return response()->json([
            'success' => true,
            'details' => $callDetails
        ]);
    }


    public function deleteCall(Request $request)
    {
        if (!auth()->user()->hasAnyRole(['calls_yetkilisi', 'admin'])) {
            return response()->json(['success' => false, 'message' => 'Bu işlemi yapmak için yetkiniz yok.'], 403);
        }
    
        $callId = $request->input('call_id');
    
        if (!$callId) {
            return response()->json(['success' => false, 'message' => 'Arama ID\'si bulunamadı.'], 400);
        }
    
        $call = Call::find($callId);
    
        if (!$call) {
            return response()->json(['success' => false, 'message' => 'Arama kaydı bulunamadı.'], 404);
        }
    
        $call->delete();
    
        return response()->json(['success' => true, 'message' => 'Arama kaydı başarıyla silindi.']);
    }
    

}

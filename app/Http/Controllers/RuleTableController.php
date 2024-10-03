<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RuleTable;
use Illuminate\Support\Facades\Auth;

class RuleTableController extends Controller
{


    public function index()
    {
        return view('content.apps.ruletable.index');
    }

    public function indexjson($id)
    {
        $ruleTable = RuleTable::where('table_id', $id)->get(); 
    
        return response()->json([
            'data' => $ruleTable
        ]);
    }
    




    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rule_name' => 'required|string|max:255',
            'rule_description' => 'required|string',
            'rule_type' => 'required|string|max:255',
            'rule_threat_level' => 'required|integer|min:0|max:9',
            'rule_source' => 'required|string',
            'rule_destination' => 'required|string',
            'rule_conditions' => 'required|string',
            'rule_related' => 'nullable|string',
            'rule_status' => 'required|string|max:50',
            'rule_category' => 'required|string',
            'rule_tags' => 'nullable|string',
            'rule_applicability' => 'required|string|max:255',
            'rule_risk_score' => 'required|integer|min:0|max:99',
            'rule_test_status' => 'nullable|string|max:255',
            'rule_test_date' => 'nullable|date',
            'rule_tested_by' => 'nullable|string|max:40',
            'rule_alert_level' => 'nullable|string|max:50',
            'rule_documentation' => 'nullable|string|max:255',
            'rule_related_policies' => 'nullable|string',
            'rule_audit_log' => 'nullable|string',
            'rule_incident_logs' => 'nullable|string',
            'rule_requirements' => 'nullable|string',
            'rule_priority' => 'required|string|max:50',
            'rule_related_assets' => 'nullable|string|max:255',
        ]);

        $validatedData['rule_created_by'] = Auth::id();
        $validatedData['rule_updated_by'] = Auth::id();

        RuleTable::create($validatedData);

        return response()->json(['message' => 'Yeni kural başarıyla eklendi!']);
    }

    public function updateRule(Request $request)
    {
        $rules = [
            'rule_id' => 'required|integer|exists:rule_tables,id',
            'table_id' => 'required|integer',
            'rule_name' => 'required|string|max:255',
            'rule_description' => 'required|string',
            'rule_type' => 'required|string|max:255',
            'rule_threat_level' => 'required|integer',
            'rule_source' => 'required|string',
            'rule_destination' => 'required|string',
            'rule_conditions' => 'required|string',
            'rule_related' => 'nullable|string',
            'rule_status' => 'required|string|max:50',
            'rule_category' => 'required|string',
            'rule_applicability' => 'required|string|max:255',
            'rule_risk_score' => 'required|integer',
            'rule_test_status' => 'nullable|string|max:255',
            'rule_test_date' => 'nullable|date',
            'rule_tested_by' => 'nullable|string|max:40',
            'rule_alert_level' => 'required|string|max:50',
            'rule_documentation' => 'nullable|string|max:255',
            'rule_related_policies' => 'nullable|string',
            'rule_audit_log' => 'nullable|string',
            'rule_incident_logs' => 'nullable|string',
            'rule_requirements' => 'nullable|string',
            'rule_priority' => 'required|string|max:50',
            'rule_related_assets' => 'nullable|string|max:255',
        ];
        

            $validatedData = $request->validate($rules);
    
            $rule = RuleTable::find($validatedData['rule_id']);
    
            if (!$rule) {
                return response()->json(['error' => 'Kural Bulunamadı'], 404);
            }
    
            $validatedData['rule_created_by'] = auth()->user()->id;
            $validatedData['rule_updated_by'] = auth()->user()->id;
    
            $rule->fill($validatedData);
            $rule->save();
    
            return response()->json(['success' => 'Kural başarıyla güncellendi!']);
    

    }
    
    
    
    

    public function destroy(Request $request)
    {
        $rules = [
            'row_id' => 'required|integer',
        ];

        $validatedData = $request->validate($rules);

        $ruleTable = RuleTable::where('id', $validatedData['row_id'])
            ->firstOrFail();

        $ruleTable->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kural başarıyla silindi!'
        ]);
    }
}

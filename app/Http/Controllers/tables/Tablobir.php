<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\CellContent;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Tablobir extends Controller
{
  public function index()
  {
    $data = User::all();
    return view('content.tables.tabledeneme', ['data' => $data]);
  }

  public function listjs()
  {
    $data = CellContent::all();
    $positions = Position::all();
    return response()->json(['success' => true, 'data' => $data, 'positions' => $positions]);  
  }

  public function addColumn(Request $request)
  {
      $request->validate([
          'table' => 'required|string|alpha_dash',
          'column' => 'required|string|alpha_dash',
          'type' => 'required|string|in:string,integer,text',
      ]);
  
      $tableName = $request->input('table');
      $columnName = $request->input('column');
      $columnType = $request->input('type');
  
      $sql = "ALTER TABLE $tableName ADD $columnName $columnType";
  
      DB::statement($sql);
  
      return redirect()->back()->with('status', 'Column added successfully!');
  }
  
}

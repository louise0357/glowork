<?php
namespace App\Http\Controllers;

use App\Models\Column;
use App\Models\CellContent;
use App\Models\Table;
use Illuminate\Http\Request;

class GetAssigned extends Controller
{
    public function getUserData($userId)
    {
        $columns = Column::where('type', 'assigned')->get();
        $results = [];

        foreach ($columns as $column) {
            $cellContents = CellContent::where('column_id', $column->id)->get();

            foreach ($cellContents as $cellContent) {
                $userIds = explode(',', $cellContent->contents);

                if (in_array($userId, $userIds)) {
                    $tableRowId = $cellContent->table_rows_id;

                    $columnDetails = Column::find($column->id);

                    $table = Table::find($columnDetails->table_id);

                    $result = [
                        'table_name' => $table->name,
                        'column_name' => $columnDetails->name,
                        'row_id' => $tableRowId
                    ];

                    $results[] = "{$result['table_name']} > {$result['column_name']} > {$result['row_id']}";
                }
            }
        }

        return response()->json($results);
    }
}

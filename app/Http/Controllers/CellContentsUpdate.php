<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Column;

class CellContentsUpdate extends Controller
{
    public function updateCellContent(Request $request)
    {
        $rowId = $request->input('row_id');
        $statusColumns = $request->input('status_columns', []);
        $tableId = $request->input('table_id');

        $table = \App\Models\Table::find($tableId);

        if ($table) {
            $tableName = $table->name;
        }
        
        if (!$rowId || !$tableId) {
            return response()->json(['error' => 'Row ID or Table ID is missing'], 400);
        }

        try {
            foreach ($statusColumns as $columnId) {
                $selectedStatusIds = $request->input('status_ids_' . $columnId, []);

                DB::table('status_details')
                    ->where('column_id', $columnId)
                    ->where('row_id', $rowId)
                    ->delete();

                if (!empty($selectedStatusIds)) {
                    foreach ($selectedStatusIds as $statusId) {
                        DB::table('status_details')->insert([
                            'table_id' => $tableId,
                            'column_id' => $columnId,
                            'row_id' => $rowId,
                            'status_id' => $statusId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            $assignedColumnIds = $request->input('assigned_columns', []);
            foreach ($assignedColumnIds as $columnId) {
                $selectedAssignedIds = $request->input('assigned_ids_' . $columnId, []);
                $assignedIds = implode(',', $selectedAssignedIds);

                $existingContents = DB::table('cell_contents')
                    ->where('table_rows_id', $rowId)
                    ->where('column_id', $columnId)
                    ->first();

                DB::table('cell_contents')
                    ->updateOrInsert(
                        ['table_rows_id' => $rowId, 'column_id' => $columnId],
                        ['contents' => $assignedIds]
                    );

                if (!$existingContents || $existingContents->contents !== $assignedIds) {
                    foreach ($selectedAssignedIds as $userId) {
                        DB::table('notifications')->insert([
                            'type' => 'App\Notifications\CustomNotification',
                            'notifiable_type' => 'App\Models\User',
                            'notifiable_id' => $userId,
                            'data' => json_encode([
                                'message' => $tableName . ' isimli tablonun, ' . $rowId . " ID'li satırına ilgili kişi olarak eklendiniz!",
                                'url' => '/table/' . $tableId
                            ]),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                } else if ($existingContents) {
                    foreach ($selectedAssignedIds as $userId) {
                        DB::table('notifications')->insert([
                            'type' => 'App\Notifications\CustomNotification',
                            'notifiable_type' => 'App\Models\User',
                            'notifiable_id' => $userId,
                            'data' => json_encode([
                                'message' => 'İlgili kişi olarak etiketlendiğiniz ' . $tableName . ' isimli tablonun, ' . $rowId . " ID'li satırında değişiklik yapılmıştır!",
                                'url' => '/table/' . $tableId
                            ]),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            foreach ($request->all() as $key => $value) {
                if (strpos($key, 'calls_') === 0) {
                    $columnId = str_replace('calls_', '', $key);

                    if (is_array($value)) {
                        $callIds = implode(',', $value);
                        DB::table('cell_contents')
                            ->updateOrInsert(
                                ['table_rows_id' => $rowId, 'column_id' => $columnId],
                                ['contents' => $callIds]
                            );
                    }
                }
            }

            $columnsAndValues = $request->except(['_token', 'row_id', 'table_id', 'status_columns', ...array_map(fn($id) => 'status_ids_' . $id, $statusColumns)]);

            foreach ($columnsAndValues as $key => $value) {
                if (strpos($key, 'column_') === 0 && !empty($value)) {
                    $columnId = str_replace('column_', '', $key);

                    DB::table('cell_contents')
                        ->updateOrInsert(
                            ['table_rows_id' => $rowId, 'column_id' => $columnId],
                            ['contents' => $value]
                        );
                }
            }

            return redirect()->back()->with('success', 'Cell content and statuses updated successfully');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

}

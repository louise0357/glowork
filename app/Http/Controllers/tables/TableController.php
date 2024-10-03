<?php
namespace App\Http\Controllers\tables;

use App\Models\Table;
use App\Models\Column;
use App\Models\TableRow;
use App\Models\CellContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Call;
use App\Models\AssignedUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\TableMainCategory;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class TableController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $tables = Table::where('created_by', Auth::id())->get();
        return view('content.tables.show', compact('tables'));
    }

    public function create()
    {
        return view('content.tables.create');
    }

    public function store(Request $request)
    {
        $table = Table::create([
            'name' => $request->name,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('content.tables.show', $table);
    }

    public function show(Table $table)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can($table->name)) {
            abort(401);
        }
        

        $columns = $table->columns;
        $rows = $table->rows;
        $statuses = DB::table('status')
            ->where('table_id', $table->id)
            ->select('status.*', 'status.status')
            ->get();

        $calls = DB::table('calls')
            ->select('call_id', 'call_reason')
            ->get();

        $users = User::all();

        return view('content.tables.show', compact('table', 'columns', 'rows', 'statuses', 'calls', 'users'));
    }


    public function addColumn(Request $request, Table $table)
    {
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can($table->name)) {
            abort(401);
        }
    
        $request->validate([
            'column' => 'required|string|max:255',
            'type' => 'required|string',
        ]);

        Column::create([
            'name' => $request->column,
            'type' => $request->type,
            'table_id' => $table->id,
        ]);

        return redirect()->back()->with('success', 'Başarıyla sütun eklendi!');
    }

    public function addRow(Request $request, Table $table)
    {

        if (!auth()->user()->hasRole('admin') && !auth()->user()->can($table->name)) {
            abort(401);
        }

        $tableId = $request->input('table_id');

        $newRowId = DB::table('table_rows')->insertGetId([
            'table_id' => $tableId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($request->except(['_token', 'table_id', 'add_status_columns', 'add_assigned_columns']) as $key => $value) {
            if (Str::startsWith($key, 'add_column_')) {
                $columnId = explode('_', $key)[2];
                DB::table('cell_contents')->updateOrInsert(
                    ['table_rows_id' => $newRowId, 'column_id' => $columnId],
                    ['contents' => $value]
                );
            }
        }

        foreach ($request->except(['_token', 'table_id']) as $key => $value) {
            if (Str::startsWith($key, 'add_calls_')) {
                $columnId = explode('_', $key)[2];
                $callsValue = implode(',', $value);
                DB::table('cell_contents')->updateOrInsert(
                    ['table_rows_id' => $newRowId, 'column_id' => $columnId],
                    ['contents' => $callsValue]
                );
            }
        }

        if ($request->has('add_status_columns')) {
            foreach ($request->input('add_status_columns') as $columnId) {
                if ($request->has("add_status_ids_{$columnId}")) {
                    $statusIds = $request->input("add_status_ids_{$columnId}");
                    $statusValue = implode(',', $statusIds);
                    DB::table('cell_contents')->updateOrInsert(
                        ['table_rows_id' => $newRowId, 'column_id' => $columnId],
                        ['contents' => $statusValue]
                    );
                } else {
                    DB::table('cell_contents')->where('table_rows_id', $newRowId)->where('column_id', $columnId)->delete();
                }
            }
        }

        if ($request->has('add_assigned_columns')) {
            foreach ($request->input('add_assigned_columns') as $columnId) {
                if ($request->has("add_assigned_ids_{$columnId}")) {
                    $assignedIds = $request->input("add_assigned_ids_{$columnId}");
                    $assignedValue = implode(',', $assignedIds);
                    DB::table('cell_contents')->updateOrInsert(
                        ['table_rows_id' => $newRowId, 'column_id' => $columnId],
                        ['contents' => $assignedValue]
                    );
                }
            }
        }

        return redirect()->back()->with('success', 'Satır başarıyla eklendi!');
        //return response()->json(['success' => 'Satır başarıyla eklendi!']);
    }



    /*
        public function updateRow(Request $request, TableRow $row)
        {
            $this->authorize('update', $row->table);

            foreach ($row->cellContents as $cell) {
                $cell->update([
                    'content' => $request->input('column_' . $cell->column_id),
                ]);
            }

            $row->update([
                'last_modified_by' => Auth::id(),
            ]);

            ChangeLog::create([
                'table_rows_id' => $row->id,
                'user_id' => Auth::id(),
                'change_description' => 'Satır güncellendi',
            ]);

            return redirect()->route('tables.show', $row->table);
        }
    */
    public function listjs(Request $request)
    {
        
        if ($request->input('row_id')) {
            $tableId = $request->input('table_id');
            $row_id = $request->input('row_id');

            $columns = Column::where('table_id', $tableId)->get();
            $columnIds = $columns->pluck('id');
            $data = CellContent::where('table_rows_id', $row_id)
                ->whereIn('column_id', $columnIds)
                ->get();
            $statuses = DB::table('status_details')
                ->join('status', 'status_details.status_id', '=', 'status.id')
                ->where('status_details.table_id', $tableId)
                ->select('status_details.*', 'status.status', 'status.class')
                ->get();

            $callsData = [];
            if ($columns->contains('type', 'calls')) {
                $callsData = Call::all();
            }

            $assignedUsersData = [];
            if ($columns->contains('type', 'assigned')) {
                $assignedUsersData = AssignedUsers::all();
            }
            $files = Storage::disk('public')->files('uploads');

            return response()->json([
                'success' => true,
                'data' => $data,
                'columns' => $columns,
                'statuses' => $statuses,
                'calls' => $callsData,
                'assigned_users' => $assignedUsersData,
                'files' => $files
            ]);
        }
        $tableId = $request->input('table_id');

        $columns = Column::where('table_id', $tableId)->get();
        $columnIds = $columns->pluck('id');
        $data = CellContent::whereIn('column_id', $columnIds)->get();

        $statuses = DB::table('status_details')
            ->join('status', 'status_details.status_id', '=', 'status.id')
            ->where('status_details.table_id', $tableId)
            ->select('status_details.*', 'status.status', 'status.class')
            ->get();

        $callsData = [];
        if ($columns->contains('type', 'calls')) {
            $callsData = Call::all();
        }

        $assignedUsersData = [];
        if ($columns->contains('type', 'assigned')) {
            $assignedUsersData = AssignedUsers::all();
        }
        $files = Storage::disk('public')->files('uploads');

        return response()->json([
            'success' => true,
            'data' => $data,
            'columns' => $columns,
            'statuses' => $statuses,
            'calls' => $callsData,
            'assigned_users' => $assignedUsersData,
            'files' => $files
        ]);


    }


    public function jsonbabus()
    {
        return view('content.tables.json');
    }


    public function getMainCategories()
    {
        $categories = TableMainCategory::all();
        return response()->json($categories);
    }


    public function storeStatus(Request $request)
    {
        $colorClassMap = [
            'Yeşil' => 'bg-label-success',
            'Kırmızı' => 'bg-label-danger',
            'Mor' => 'bg-label-primary',
            'Gri' => 'bg-label-secondary',
            'Turuncu' => 'bg-label-warning',
            'Mavi' => 'bg-label-info',
            'Siyah' => 'bg-label-dark',
        ];

        $tableId = $request->input('table_id');
        $table = Table::where('id', $tableId)->get();
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can($table->name)) {
            abort(401);
        }
        $statusName = $request->input('name');
        $statusColor = $request->input('color');

        $class = $colorClassMap[$statusColor] ?? null;

        DB::table('status')->insert([
            'table_id' => $tableId,
            'status' => $statusName,
            'class' => $class,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => 'Status başarıyla tabloya eklendi.']);

        // return redirect()->back()->with('success', 'Status başarıyla kaydedildi!');
    }



    public function deleteRow(Request $request)
    {
        $request->validate([
            'row_id' => 'required|integer|exists:table_rows,id',
        ]);
    
        $row_table = TableRow::where('id', $request->row_id)->first();
    
        if (!$row_table) {
            return response()->json(['success' => false, 'message' => 'Satır bulunamadı.'], 404);
        }
    
        $table = Table::where('id', $row_table->table_id)->first();
    
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can($table->name)) {
            abort(401);
        }
    
        CellContent::where('table_rows_id', $request->row_id)->delete();
    
        TableRow::destroy($request->row_id);
    
        return response()->json(['success' => true, 'message' => 'Satır başarıyla silindi.']);
    }
    


    public function createMainCategory(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(401);
        }

        $request->validate([
            'mainCategoryName' => 'required|string|max:255',
        ]);


        $mainCategory = new TableMainCategory();
        $mainCategory->title = $request->mainCategoryName;
        $mainCategory->created_by = auth()->user()->id;
        $mainCategory->save();

        Permission::create(['name' => $mainCategory->title]);

        return response()->json([
            'success' => true,
            'message' => 'Ana kategori başarıyla oluşturuldu!',
        ]);
    }


    public function createSubCategory(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(401);
        }

        $request->validate([
            'subCategoryName' => 'required|string|max:255',
            'mainCategoryId' => 'required|exists:main_categories,id',
        ]);

        $subCategory = new Table();
        $subCategory->name = $request->subCategoryName;
        $subCategory->main_category_id = $request->mainCategoryId;
        $subCategory->save();

        Permission::create(['name' => $subCategory->name]);


        return response()->json(['message' => 'Alt kategori başarıyla oluşturuldu']);
    }


    public function deleteMainCategory(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(401);
        }

        $request->validate([
            'mainCategoryId' => 'required|exists:main_categories,id',
        ]);
    
        $tablemain = TableMainCategory::find($request->mainCategoryId);
    
        if ($tablemain) {
            $tables = Table::where('main_category_id', $request->mainCategoryId)->get();
    
            foreach ($tables as $table) {
                $columns = Column::where('table_id', $table->id)->get();
                foreach ($columns as $column) {
                    CellContent::where('column_id', $column->id)->delete();
                    $column->delete();
                }
    
                $rows = TableRow::where('table_id', $table->id)->get();
                foreach ($rows as $row) {
                    CellContent::where('table_rows_id', $row->id)->delete();
                    $row->delete();
                }
    
                $table->delete();
                $this->deletePermission($table->name);

            }
    
            $this->deletePermission($tablemain->title);
    
            $tablemain->delete();
    
            return response()->json(['message' => 'Main Kategori ve bağlı veriler başarıyla silindi.'], 200);
        } else {
            return response()->json(['message' => 'Main Kategori silinirken bir hata oluştu!'], 404);
        }
    }

    public function deleteSubCategory(Request $request) 
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(401);
        }

        $request->validate([
            'id' => 'required|integer',
        ]);
    
        $tables = Table::where('id', $request->id)->get();
    
        if ($tables) {    
            foreach ($tables as $table) {
                $columns = Column::where('table_id', $table->id)->get();
                foreach ($columns as $column) {
                    CellContent::where('column_id', $column->id)->delete();
                    $column->delete();
                }
    
                $rows = TableRow::where('table_id', $table->id)->get();
                foreach ($rows as $row) {
                    CellContent::where('table_rows_id', $row->id)->delete();
                    $row->delete();
                }
    
                $table->delete();
                $this->deletePermission($table->name);

            }
    
            return response()->json(['message' => 'Sub Kategori ve bağlı veriler başarıyla silindi.'], 200);
        } else {
            return response()->json(['message' => 'Sub Kategori silinirken bir hata oluştu!'], 404);
        }

    }
    
    public function deletePermission($permissionName)
    {
        
        $permission = Permission::where('name', $permissionName)->first();
    
        if ($permission) {
            $permission->delete();
            return "Permission '{$permissionName}' başarıyla silindi.";
        }
    
        return "Permission '{$permissionName}' bulunamadı.";
    }
    
    public function getSubCategories(Request $request, $id) {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:tables,main_category_id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid category ID.'], 400);
        }
    
        $subCategories = Table::where('main_category_id', $id)->get();
    
        return response()->json($subCategories);
    }

}

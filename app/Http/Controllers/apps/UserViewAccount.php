<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Column;
use App\Models\CellContent;
use App\Models\Table;
use App\Models\TableMainCategory;
use App\Models\KanbanTask;
use App\Models\KanbanList;
use App\Models\KanbanBoard;
use App\Models\KanbanMainCategory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserViewAccount extends Controller
{
    public function index()
    {
        return view('content.apps.app-user-view-account');
    }

    public function viewAccount($id)
    {
        $user = User::findOrFail($id);
        
        $data = $this->getUserData($id);
        $kanbanData = $this->getUserKanbanData($id);
    
        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions();

        $fullroles = Role::all();
        $fullpermissions = Permission::all();
    
        if (!Auth::user()->hasRole('admin') && Auth::id() !== $user->id) {
            return redirect()->back()->with('error', 'Bu kullanıcı profilini görüntüleme izniniz yok.');
        }
    
        return view('content.apps.app-user-view-account', compact('user', 'data', 'kanbanData', 'roles', 'permissions', 'fullroles', 'fullpermissions'));
    }
    

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
                    $tableMainCategory = TableMainCategory::find($table->id);

                    $results[] = [
                        'table_main_category' => $tableMainCategory->title,
                        'table_id' => $table->id,
                        'table_name' => $table->name,
                        'column_name' => $columnDetails->name,
                        'row_id' => $tableRowId
                    ];
                }
            }
        }

        return $results; 
    }

    public function getUserKanbanData($userId)
    {
        $tasks = KanbanTask::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        $results = [];

        foreach ($tasks as $task) {
            $list = $task->list;

            if ($list) {
                $board = KanbanBoard::find($list->board_id);
                $boardmain = KanbanMainCategory::find($board->main);

                if ($board) {
                    $results[] = [
                        'board_main' => $boardmain->name,
                        'board_id' => $board->id,
                        'board_name' => $board->name,
                        'list_name' => $list->name,
                        'task_name' => $task->name
                    ];
                }
            }
        }

        return $results; 
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'roles' => 'array',
            'permissions' => 'array',
        ]);
    
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->save();
    
        if ($request->roles) {
            $user->syncRoles($request->roles);
        }
    
        $user->syncPermissions($request->permissions ?? []);
    
        return redirect()->back()->with('success', 'Kullanıcı bilgileri başarıyla güncellendi.');
        //return response()->json(['success' => true, 'message' => 'Kullanıcı bilgileri başarıyla güncellendi.']);
    }
    
}

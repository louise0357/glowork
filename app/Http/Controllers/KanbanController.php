<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KanbanBoard;
use App\Models\KanbanTask;
use App\Models\KanbanList;
use Illuminate\Support\Facades\Log;
use App\Models\KanbanMainCategory;
use Illuminate\Support\Facades\DB;
use App\Models\KanbanComment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Models\TableRow;
use App\Models\CellContent;
use App\Models\Column;


class KanbanController extends Controller
{
    use AuthorizesRequests;

    public function index($id)
    {

        $kanbanname = KanbanBoard::where('id', $id)->first();
        if (!auth()->user()->hasRole('admin') && !auth()->user()->can($kanbanname->name)) {
            abort(401);
        }
        
        $users = User::select('id', 'username', 'name')->get();

        return view('content.apps.app-kanban', compact('users'));
    }


    public function getBoard($boardId)
    {
        $board = KanbanBoard::with('lists.tasks.users')->find($boardId);

        if (!$board) {
            return response()->json(['message' => 'Board not found'], 404);
        }

        $response = $board->lists->map(function ($list) {
            return [
                'id' => 'board-' . $list->id,
                'order' => $list->order,
                'title' => $list->name,
                'item' => $list->tasks->map(function ($task) {
                    $assignedUsers = $task->users->map(function ($user) {
                        return $user->username;
                    });
                    $assignedUsersPhoto = $task->users->map(function ($user) {
                        return $user->profile_photo_url;
                    });

                    return [
                        'id' => 'task-' . $task->id,
                        'title' => $task->name,
                        'comments' => '',
                        'badge-text' => $task->label,
                        'badge' => $task->badge,
                        'due-date' => $task->due_date,
                        'attachments' => '',
                        'assigned' => $assignedUsersPhoto,
                        'members' => $assignedUsers,
                        'description' => $task->description,
                        'type' => $task->type
                    ];
                })->toArray()
            ];
        })->toArray();

        return response()->json($response);
    }

    public function getTask($taskId)
    {
        $task = KanbanTask::with('users')->find($taskId);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $assignedUsers = $task->users->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
            ];
        });

        return response()->json([
            'id' => 'task-' . $task->id,
            'title' => $task->name,
            'comments' => $task->comments_count,
            'badge-text' => $task->label,
            'badge' => 'secondary',
            'due-date' => $task->due_date,
            'attachments' => $task->attachments,
            'assigned_users' => $assignedUsers,
        ]);
    }

    public function kanbanSurukleme(Request $request)
    {
        $taskId = $request->input('task_id');

        $numericTaskId = intval(explode('-', $taskId)[1]);

        $newBoardId = $request->input('new_board_id');

        $numericBoardId = intval(explode('-', $newBoardId)[1]);


        $task = KanbanTask::find($numericTaskId);

        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        $newList = KanbanList::where('id', $numericBoardId)->first();

        if (!$newList) {
            return response()->json(['success' => false, 'message' => 'New board not found'], 404);
        }

        $task->list_id = $newList->id;
        $task->save();

        return response()->json(['success' => true, 'message' => 'Task moved successfully']);
    }


    public function TaskUpdate(Request $request)
    {
        $taskId = $request->input('task_id');
        $taskId = str_replace('task-', '', $taskId);

        $title = $request->input('title');
        $dueDate = $request->input('due_date');
        $label = $request->input('label');
        $assigned = $request->input('assigned');
        $description = $request->input('description');
        $attachments = $request->file('attachments');

        $task = KanbanTask::find($taskId);

        if ($task) {
            $task->name = $title;
            $task->due_date = $dueDate;
            $task->label = $label;
            $task->assigned_user = $assigned;
            $task->description = $description;

            if ($attachments) {
                $filePath = $attachments->store('attachments', 'public');
                $task->attachments = $filePath;
            }

            $task->save();

            return response()->json(['success' => true, 'message' => 'Task updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Task not found'], 404);
    }

    /*
        public function addBoard(Request $request)
        {
            $request->validate([
                'board_id' => 'required|integer',
                'name' => 'required|string|max:255',
            ]);

            try {
                $board = new KanbanList();
                $board->board_id = $request->input('board_id');
                $board->name = $request->input('name');
                $board->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Board successfully added!',
                    'board' => $board
                ]);
            } catch (\Exception $e) {
                Log::error('Error adding board: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error adding board: ' . $e->getMessage(),
                ]);
            }
        }
    */
    public function addTask(Request $request)
    {
        $request->validate([
            'board_id' => 'required|integer',
            'content' => 'required|string',
        ]);

        try {
            $task = new KanbanTask();
            $task->list_id = $request->input('board_id');
            $task->name = $request->input('content');
            $task->save();

            return response()->json([
                'success' => true,
                'message' => 'Task successfully added!',
                'task' => $task
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding task: ' . $e->getMessage(),
            ]);
        }
    }


    public function storeBoard(Request $request)
    {
        $request->validate([
            'board_id' => 'required|integer',
            'title' => 'required|string|max:255',
        ]);

        try {
            $board = new KanbanList();
            $board->board_id = $request->input('board_id');
            $board->name = $request->input('title');
            $board->save();

            return response()->json(['success' => true, 'message' => 'Board başarıyla eklendi!', 'board' => $board], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Board eklenirken bir hata oluştu.', 'error' => $e->getMessage()], 500);
        }



    }

    public function deleteTask($id)
    {
        try {
            $task = KanbanTask::findOrFail($id);
            $task->delete();

            return response()->json([
                'success' => true,
                'message' => 'Task successfully deleted!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting task: ' . $e->getMessage(),
            ]);
        }
    }


    public function deleteBoard($id)
    {
        try {
            $board = KanbanList::findOrFail($id);

            KanbanTask::where('list_id', $id)->delete();

            $board->delete();

            return response()->json([
                'success' => true,
                'message' => 'Board başarıyla silindi!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Board silinirken hata oluştu: ' . $e->getMessage(),
            ]);
        }
    }


    public function getMainCategories()
    {
        $categories = KanbanMainCategory::all();
        return response()->json($categories);
    }


    public function createMainCategory(Request $request)
    {
        $request->validate([
            'mainCategoryName' => 'required|string|max:255',
        ]);

        $mainCategory = new KanbanMainCategory();
        $mainCategory->name = $request->mainCategoryName;
        $mainCategory->save();

        Permission::create(['name' => $mainCategory->name]);

        return response()->json(['message' => 'Ana kategori başarıyla oluşturuldu']);
    }

    public function createSubCategory(Request $request)
    {
        $request->validate([
            'subCategoryName' => 'required|string|max:255',
            'mainCategoryId' => 'required|integer|max:11',
        ]);

        $subCategory = new KanbanBoard();
        $subCategory->name = $request->subCategoryName;
        $subCategory->main = $request->mainCategoryId;
        $subCategory->save();

        Permission::create(['name' => $subCategory->name]);


        return response()->json(['message' => 'Alt kategori başarıyla oluşturuldu']);
    }


    public function getBoards()
    {
        $boards = KanbanBoard::with('lists.tasks')->get();

        $response = $boards->map(function ($board) {
            return [
                'id' => 'board-' . $board->id,
                'name' => $board->name,
                'main_category' => $board->mainCategory ? $board->mainCategory->name : null,
                'lists' => $board->lists->map(function ($list) {
                    return [
                        'id' => 'list-' . $list->id,
                        'title' => $list->name,
                        'tasks' => $list->tasks->map(function ($task) {
                            return [
                                'id' => 'task-' . $task->id,
                                'title' => $task->name,
                                'due_date' => $task->due_date,
                                'label' => $task->label,
                                'assigned_user' => $task->assigned_user,
                            ];
                        })->toArray(),
                    ];
                })->toArray(),
            ];
        })->toArray();

        return response()->json($response);
    }



    public function updateOrder(Request $request)
    {
        $request->validate([
            'board_id' => 'required|integer',
            'lists' => 'required|array',
            'lists.*.id' => 'required|integer|exists:kanban_lists,id',
            'lists.*.order' => 'required|integer'
        ]);

        $boardId = $request->input('board_id');
        $lists = $request->input('lists');

        foreach ($lists as $listData) {
            KanbanList::where('id', $listData['id'])
                ->where('board_id', $boardId)
                ->update(['order' => $listData['order']]);
        }

        return response()->json(['message' => 'Order updated successfully.']);
    }



    public function getTaskComments($id)
    {
        $comments = KanbanComment::where('kanban_task_id', $id)
            ->with('user')
            ->get();

        return response()->json($comments);
    }



    public function addComment(Request $request)
    {
        $validatedData = $request->validate([
            'task_id' => 'required|integer',
            'comment' => 'required|string|max:1000',
        ]);

        $comment = KanbanComment::create([
            'kanban_task_id' => $validatedData['task_id'],
            'user_id' => Auth::id(),
            'comment' => $validatedData['comment'],
        ]);

        return response()->json(['success' => 'true', 'comment' => $comment, 'user' => ['profile_photo_url' => Auth::user()->profile_photo_url, 'username' => Auth::user()->username]], 200);

    }




    public function updateComment(Request $request, KanbanComment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment->comment = $request->comment;
        $comment->save();

        return response()->json($comment, 200);
    }

    public function deleteComment(KanbanComment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(['success' => 'true'], 200);
    }


    public function assignUsers(Request $request)
    {
        $request->validate([
            'task_id' => 'required|integer|exists:kanban_tasks,id',
            'assigned_users' => 'nullable|array',
            'assigned_users.*' => 'integer|exists:users,id',
        ]);

        $task = KanbanTask::findOrFail($request->task_id);

        DB::table('kanban_task_users')->where('task_id', $task->id)->delete();

        if ($request->has('assigned_users')) {
            foreach ($request->assigned_users as $userId) {
                DB::table('kanban_task_users')->updateOrInsert(
                    ['task_id' => $task->id, 'user_id' => $userId],
                    ['assigned_at' => now()]
                );
            }
        }

        return response()->json(['success' => 'Users successfully assigned to the task.']);
    }



    public function getSubCategories(Request $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:kanban_boards,main',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid category ID.'], 400);
        }

        $subCategories = KanbanBoard::where('main', $id)->get();

        return response()->json($subCategories);
    }

    public function getKanbanLists(Request $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid Sub Category ID.'], 400);
        }

        $subCategories = KanbanList::where('board_id', $id)->get(["id", "name"]);

        return response()->json($subCategories);
    }




    public function deleteMainCategory(Request $request)
    {


        $request->validate([
            'mainCategoryId' => 'required|integer',
        ]);

        $kanbanmain = KanbanMainCategory::find($request->mainCategoryId);

        if ($kanbanmain) {
            $board = KanbanBoard::where('main', $kanbanmain->id)->get();
            if ($board) {
            $this->deletePermission($board->name);
            $board->delete();
        } else {
            return response()->json(['message' => 'Kanban board bulunamadı'], 404);
        }

        $kanbanLists = KanbanList::where('board_id', $request->id)->get();

        if ($kanbanLists->isNotEmpty()) {
            $listIds = $kanbanLists->pluck('id');
            KanbanList::whereIn('id', $listIds)->delete();

            KanbanTask::whereIn('list_id', $listIds)->delete();
        }

        $this->deletePermission($kanbanmain->name);
    
        $kanbanmain->delete();

        return response()->json(['message' => 'Kanban board, listeler ve ilgili görevler başarıyla silindi'], 200);
        } else {
            return response()->json(['message' => 'Kanban board, listeler ve ilgili görevler silinirken bir hata oluştu!'], 404);
        }
    }




    public function deleteSubCategory(Request $request)
    {


        $request->validate([
            'id' => 'required|integer',
        ]);


        $board = KanbanBoard::find($request->id);
        if ($board) {
            $this->deletePermission($board->name);
            $board->delete();
        } else {
            return response()->json(['message' => 'Kanban board bulunamadı'], 404);
        }

        $kanbanLists = KanbanList::where('board_id', $request->id)->get();

        if ($kanbanLists->isNotEmpty()) {
            $listIds = $kanbanLists->pluck('id');
            KanbanList::whereIn('id', $listIds)->delete();

            KanbanTask::whereIn('list_id', $listIds)->delete();
        }

        return response()->json(['message' => 'Kanban board, listeler ve ilgili görevler başarıyla silindi'], 200);

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

    public function sendToKanban(Request $request)
    {
        $selectedRows = $request->input('selectedRows');
    
        $allRowsData = [];
    
        foreach ($selectedRows as $rowId) {
            $row = TableRow::find($rowId);
            
            $cellContents = CellContent::where('table_rows_id', $rowId)->get();
    
            $rowData = [];
            foreach ($cellContents as $cellContent) {
                $column = Column::find($cellContent->column_id);
                
                $rowData[$column->name] = $cellContent->contents;
            }
    
            $allRowsData[] = $rowData;
        }
    
        $jsonTableRows = json_encode($allRowsData, JSON_PRETTY_PRINT);
    
        KanbanTask::create([
            'list_id' => $request->input('list_id'),
            'name' => 'Task from Table Rows', 
            'description' => 'This task contains data from selected table rows',
            'type' => 'sendedfromtable',
            'table_rows' => $jsonTableRows, 
            'due_date' => now()->addDays(7),
        ]);
    
        return response()->json(['success' => 'Rows successfully sent to Kanban!']);
    }
    

    public function getTaskDetails($id)
{
    $task = KanbanTask::find($id);
    if ($task && $task->type == 'sendedfromtable') {
        return response()->json(json_decode($task->table_rows), 200);
    } else {
        return response()->json([], 404);
    }
}
    

}

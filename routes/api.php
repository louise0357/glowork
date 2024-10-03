<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CallAddApi;
use App\Http\Controllers\KanbanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:api')->group(function () {
    // Yorum Ekleme
    Route::post('/comments', [KanbanController::class, 'addComment']);

    // Yorum Güncelleme
    Route::put('/comments/{id}', [KanbanController::class, 'updateComment']);

    // Yorum Silme
    Route::delete('/comments/{id}', [KanbanController::class, 'deleteComment']);

    Route::get('/tasks/{taskId}/comments', [KanbanController::class, 'getComments']);
});
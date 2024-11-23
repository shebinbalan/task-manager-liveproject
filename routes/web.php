<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/home', [App\Http\Controllers\Admin\FrontendController::class,'index']);


    

//categories
        Route::get('/projects', [ProjectController::class,'index']);
        Route::get('/add-projects', [ProjectController::class,'create']);
        Route::post('/insert-projects', [ProjectController::class,'store']);
        Route::get('show-projects/{id}', [ProjectController::class,'show']);
        Route::get('/edit-projects/{id}', [ProjectController::class,'edit']);
        Route::put('/update-projects/{id}', [ProjectController::class,'update']);
        Route::get('/delete-projects/{id}', [ProjectController::class,'destroy']);




//incomes
         Route::get('/tasks', [TaskController::class,'index']);
         Route::get('/add-tasks', [TaskController::class,'create']);
         Route::post('/insert-tasks', [TaskController::class,'store']);
         Route::get('show-tasks/{id}', [TaskController::class,'show']);
         Route::get('/edit-tasks/{id}', [TaskController::class,'edit']);
         Route::put('/update-tasks/{id}', [TaskController::class,'update']);
         Route::get('/delete-tasks/{id}', [TaskController::class,'destroy']);

         Route::get('/tasks/export', [TaskController::class, 'exportReport'])->name('admin.tasks.exportReport');
         Route::delete('tasks/remove-attachment/{attachmentId}', [TaskController::class, 'removeAttachment']);

         Route::get('download-attachment/{attachmentId}', [TaskController::class, 'downloadAttachment']);
         Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
        Route::post('/tasks/{taskId}/start-timer', [TaskController::class, 'startTimer'])->name('admin.tasks.startTimer');
        Route::post('/tasks/{taskId}/stop-timer', [TaskController::class, 'stopTimer'])->name('admin.tasks.stopTimer');

         Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('admin.comments.store');
         Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('admin.comments.edit');
         Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('admin.comments.update');
         Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
        




        
  
  
 });

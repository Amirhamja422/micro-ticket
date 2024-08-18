<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HostController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SupportTypeController;
use App\Http\Controllers\TaskTypeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::middleware(['middleware' => 'auth'])->prefix('admin')->group(function () {

Route::middleware(['middleware' => 'auth'])->group(function () {

    ## Client
    Route::get('/host', [HostController::class, 'index'])->name('host');
    Route::get('/host-list-datatable', [HostController::class, 'datatable'])->name('host.list.datatable');
    Route::get('/host-create', [HostController::class, 'create'])->name('host.create');
    Route::post('/host-store', [HostController::class, 'store'])->name('host.store');
    Route::get('/host-status-change/{id}', [HostController::class, 'statusChange'])->name('host.status.change');
    Route::get('/host-edit/{id}', [HostController::class, 'edit'])->name('host.edit');
    Route::put('/host-data-update/{id}', [HostController::class, 'update'])->name('host.data.update');


    Route::get('/server-data-view/{id}', [ServerController::class, 'show'])->name('server.data.view');

    ## Support Type
    Route::get('/support-type', [SupportTypeController::class, 'index'])->name('support.type');
    Route::get('/support-type-create', [SupportTypeController::class, 'create'])->name('support.type.create');
    Route::post('/support-type-store', [SupportTypeController::class, 'store'])->name('support.type.store');
    Route::get('/support-type-list-datatable', [SupportTypeController::class, 'datatable'])->name('support.type.list.datatable');
    Route::get('/support-type-status-change/{id}', [SupportTypeController::class, 'statusChange'])->name('support.type.status.change');
    Route::get('/support-type-edit/{id}', [SupportTypeController::class, 'edit'])->name('support.type.edit');
    Route::put('/support-type-data-update/{id}', [SupportTypeController::class, 'update'])->name('support.type.data.update');

    ## Task Type
    Route::get('/task-type', [TaskTypeController::class, 'index'])->name('task.type');
    Route::get('/task-type-create', [TaskTypeController::class, 'create'])->name('task.type.create');
    Route::post('/task-type-store', [TaskTypeController::class, 'store'])->name('task.type.store');
    Route::get('/task-type-list-datatable', [TaskTypeController::class, 'datatable'])->name('task.type.list.datatable');
    Route::get('/task-type-status-change/{id}', [TaskTypeController::class, 'statusChange'])->name('task.type.status.change');
    Route::get('/task-type-edit/{id}', [TaskTypeController::class, 'edit'])->name('task.type.edit');
    Route::put('/task-type-data-update/{id}', [TaskTypeController::class, 'update'])->name('task.type.data.update');

    ## Support
    Route::get('/support', [SupportController::class, 'index'])->name('support');
    Route::get('/support-create', [SupportController::class, 'create'])->name('support.create');
    Route::post('/support-store', [SupportController::class, 'store'])->name('support.store');
    Route::get('/support-list-datatable', [SupportController::class, 'datatable'])->name('support.list.datatable');
    Route::get('/support-edit/{id}', [SupportController::class, 'edit'])->name('support.edit');
    Route::put('/support-data-update/{id}', [SupportController::class, 'update'])->name('support.data.update');
    Route::get('/support-delete/{id}', [SupportController::class, 'destroy'])->name('support.delete');

    ## Project
    Route::get('/project', [ProjectController::class, 'index'])->name('project');
    Route::get('/project-create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/project-store', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/project-list-datatable', [ProjectController::class, 'datatable'])->name('project.list.datatable');
    Route::get('/project-status-change/{id}', [ProjectController::class, 'statusChange'])->name('project.status.change');
    Route::get('/project-edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('/project-data-update/{id}', [ProjectController::class, 'update'])->name('project.data.update');

    ## Task
    Route::get('/task', [TaskController::class, 'index'])->name('task');
    Route::get('/task-create', [TaskController::class, 'create'])->name('task.create');
    Route::get('/task-project-name-get', [TaskController::class, 'projectName'])->name('task.project-name-get');
    Route::get('/task-project-data-get', [TaskController::class, 'projectData'])->name('task.project-data-get');
    Route::post('/task-store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task-list-datatable', [TaskController::class, 'datatable'])->name('task.list.datatable');
    Route::get('/task-edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/task-data-update/{id}', [TaskController::class, 'update'])->name('task.data.update');
    Route::get('/task-delete/{id}', [TaskController::class, 'destroy'])->name('task.delete');
    Route::get('/task-show/{id}', [TaskController::class, 'show']);
    Route::post('/task-file-store', [TaskController::class, 'filStore']);


    ## Ticket
    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket');
    Route::get('/ticket-create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket-store', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/ticket-list-datatable', [TicketController::class, 'datatable'])->name('ticket.list.datatable');
});

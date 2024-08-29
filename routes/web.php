<?php

use App\Http\Controllers\SignatureController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmailConfigController;
use App\Http\Controllers\IssueOriginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketDashboardController;

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

## auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/mail-fetch', [MailController::class, 'emailGet']);


## pusher
Route::get('/pusher', [PusherController::class, 'index'])->name('pusher');
Route::get('/pusher-create', [PusherController::class, 'create'])->name('pusher.create');
Route::post('/pusher-store', [PusherController::class, 'store'])->name('pusher.store');


Route::middleware(['middleware' => 'auth'])->group(function () {
    ## dashboard
    Route::get('/', [TicketDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [TicketDashboardController::class, 'index']);


    ## Dashboard Graph
    Route::get('/dashboard-ticket', [TicketDashboardController::class, 'index']);

    ## Ticket download
    Route::get('ticket-download', [TicketController::class, 'exportExcelFile'])->name('ticket.export');

    ## user
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user-create', [UserController::class, 'create'])->name('user.create');
    Route::get('/user-list-datatable', [UserController::class, 'datatable'])->name('user.list.datatable');
    Route::post('/user-store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user-data-update/{id}', [UserController::class, 'update'])->name('user.data.update');
    Route::get('/user-status-change/{id}', [UserController::class, 'statusChange'])->name('user.status.change');

    ## Department
    Route::get('/department', [DepartmentController::class, 'index'])->name('department');
    Route::get('/dept-create', [DepartmentController::class, 'create'])->name('dept.create');
    Route::get('/dept-list-datatable', [DepartmentController::class, 'datatable'])->name('dept.list.datatable');
    Route::post('/dept-store', [DepartmentController::class, 'store'])->name('dept.store');
    Route::get('/dept-edit/{id}', [DepartmentController::class, 'edit'])->name('dept.edit');
    Route::put('/dept-data-update/{id}', [DepartmentController::class, 'update'])->name('dept.data.update');
    Route::get('/dept-status-change/{id}', [DepartmentController::class, 'statusChange'])->name('dept.status.change');

    ## Status
    Route::get('/status', [StatusController::class, 'index'])->name('status');
    Route::get('/status-list-datatable', [StatusController::class, 'datatable'])->name('status.list.datatable');
    Route::post('/status-store', [StatusController::class, 'store'])->name('status.store');
    Route::get('/status-create', [StatusController::class, 'create'])->name('status.create');
    Route::get('/status-edit/{id}', [StatusController::class, 'edit'])->name('status.edit');
    Route::put('/status-data-update/{id}', [StatusController::class, 'update'])->name('status.data.update');
    Route::get('/status-status-change/{id}', [StatusController::class, 'statusChange'])->name('status.status.change');

    ## Classifications
    Route::get('/classification', [ClassificationController::class, 'index'])->name('classification');
    Route::get('/classification-list-datatable', [ClassificationController::class, 'datatable'])->name('classification.list.datatable');
    Route::get('/classification-create', [ClassificationController::class, 'create'])->name('classification.create');
    Route::post('/classification-store', [ClassificationController::class, 'store'])->name('classification.store');
    Route::get('/classification-edit/{id}', [ClassificationController::class, 'edit'])->name('classification.edit');
    Route::put('/classification-data-update/{id}', [ClassificationController::class, 'update'])->name('classification.data.update');
    Route::get('/classification-status-change/{id}', [ClassificationController::class, 'statusChange'])->name('classification.status.change');

    ## Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category-list-datatable', [CategoryController::class, 'datatable'])->name('category.list.datatable');
    Route::get('/category-create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category-store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category-data-update/{id}', [CategoryController::class, 'update'])->name('category.data.update');
    Route::get('/category-status-change/{id}', [CategoryController::class, 'statusChange'])->name('category.status.change');

    ## Sub Category
    Route::get('/sub-category', [SubCategoryController::class, 'index'])->name('subcategory');
    Route::get('/subcategory.list.datatable', [SubCategoryController::class, 'datatable'])->name('subcategory.list.datatable');
    Route::get('/subcategory-create', [SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::post('/subcategory-store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/subcategory-edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('/subcategory-data-update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.data.update');
    Route::get('/subcategory-status-change/{id}', [SubCategoryController::class, 'statusChange'])->name('subcategory.status.change');


    ## Complain
    Route::get('/complain', [ComplainController::class, 'index'])->name('complain');
    Route::get('/complain-list-datatable', [ComplainController::class, 'datatable'])->name('complain.list.datatable');
    Route::get('/complain-create', [ComplainController::class, 'create'])->name('complain.create');
    Route::post('/complain-store', [ComplainController::class, 'store'])->name('complain.store');
    Route::get('/complain-edit/{id}', [ComplainController::class, 'edit'])->name('complain.edit');
    Route::put('/complain-data-update/{id}', [ComplainController::class, 'update'])->name('complain.data.update');
    Route::get('/complain-status-change/{id}', [ComplainController::class, 'statusChange'])->name('complain.status.change');


    ## Ticket
    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket');
    Route::get('/ticket-create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket-store', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/ticket-list-datatable', [TicketController::class, 'datatable'])->name('ticket.list.datatable');
    Route::get('/ticket-edit/{id}', [TicketController::class, 'edit'])->name('ticket.edit');
    Route::get('/ticket-cat-name-get', [TicketController::class, 'catChange'])->name('ticket.product-name-get');
    Route::put('/assign-data-update/{id}', [TicketController::class, 'assign_update'])->name('assign.data.update');
    Route::put('/status-data-update/{id}', [TicketController::class, 'status_update'])->name('status.data.update');
    Route::post('/ticket-replay', [TicketController::class, 'ticketReplay'])->name('ticket.replay');


    ## permission group
    Route::group(['middleware' => ['role_or_permission:permission.group']], function () {
        Route::get('/permission-group', [PermissionGroupController::class, 'index'])->name('permission.group');
        Route::get('/permission-group-list-datatable', [PermissionGroupController::class, 'datatable'])->name('permission.group.list.datatable');
    });

    ## permission
    Route::group(['middleware' => ['role_or_permission:permission']], function () {
        Route::get('/permission', [PermissionController::class, 'index'])->name('permission');
        Route::get('/permission-list-datatable', [PermissionController::class, 'datatable'])->name('permission-list-datatable');
    });

    ## role
    Route::group(['middleware' => ['role_or_permission:role']], function () {
        Route::get('/role', [RoleController::class, 'index'])->name('role');
        Route::get('/role-list-datatable', [RoleController::class, 'datatable'])->name('role-list-datatable');
        Route::get('/role-create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role-store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/role-edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/role/{id}/update', [RoleController::class, 'update'])->name('role.update');
    });


    ## profiles update
    Route::get('/profile-edit', [AuthController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}/update', [AuthController::class, 'profileUpdate'])->name('profile.update');

    ## passwords change
    Route::get('/password-edit', [AuthController::class, 'passEdit'])->name('password.edit');
    Route::put('/password/{id}/update', [AuthController::class, 'passUpdate'])->name('password.update');

    ## ticket notifications
    Route::get('/ticket-count', [TicketController::class, 'refresh'])->name('refresh');
    Route::get('/ticket-new-refresh', [TicketController::class, 'refreshNewTicket'])->name('refreshTicket');



});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RolesController;

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
    return view('login');
})->name('/');
Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['guest']], function() {

    //Login Routes
    Route::get('loginshow', [LoginController::class,'show'])->name('loginshow');
    Route::post('loginpost', [LoginController::class,'login'])->name('loginpost');

});

Route::group(['middleware' => ['auth']], function() {
    // Logout Routes
    Route::get('logout', [LoginController::class,'logout'])->name('logout');
    
});

Route::group(['middleware' => 'can:manage_registers'], function(){
    //Company Registration
    Route::get('companyregister', function () {
        return view('company_register');
    });
    Route::post('companyregister', [CompanyController::class,'registerCompany'])->name('companyregister');
    
    //Brach Registration
    Route::get('branchregister', [BranchController::class,'registerBranch']);
    Route::post('branchregister', [BranchController::class,'saveBranch'])->name('branchregister');

    //Get Company Details
    Route::get('getCompanyDetails', [BranchController::class,'getCompanyDetails']);

    //Product Register
    Route::get('productregister', function () {
        return view('product_register');
    });
    Route::post('productregister', [ProductController::class,'saveProduct'])->name('productregister');

    //Service Register
    Route::get('serviceregister', function () {
        return view('service_register');
    });
    Route::post('serviceregister', [ServiceController::class,'saveService'])->name('serviceregister');

    //TicketForm URL Generation
    Route::get('GetFormLink/{id}',[AdminController::class,'getFormLink']);

});

//Masters Access
Route::group(['middleware' => 'can:manage_masters'], function(){
    //Branch Master
    Route::get('branchmaster', [BranchController::class,'masterBranch'])->name('branchmaster');
    //Company Master
    Route::get('companymaster', [CompanyController::class,'companyMaster'])->name('companymaster');

    //Product Master
    Route::get('productmaster', [ProductController::class,'productMaster'])->name('productmaster');
    //Product Edit/Update
    Route::get('editproduct/{id}', [ProductController::class,'editProduct'])->name('editproduct');
    Route::post('updateproduct/{id}', [ProductController::class,'updateProduct'])->name('updateproduct');


    //Service Master
    Route::get('servicemaster', [ServiceController::class,'serviceMaster'])->name('servicemaster');

});

//Support Bucket Access
Route::group(['middleware' => 'can:support_bucket'], function(){
    Route::get('supportbucket', [AdminController::class,'supportBucket'])->name('supportbucket');
    Route::post('ticketstore', [AdminController::class,'store']);
});
//PM Bucket Access
Route::group(['middleware' => 'can:pm_bucket'], function(){
    Route::get('pmbucket', [AdminController::class,'pmBucket'])->name('pmbucket');
});
//Support Management Access
Route::group(['middleware' => 'can:management_bucket'], function(){
    Route::get('managementbucket', [AdminController::class,'managementBucket'])->name('managementbucket');
});

Route::group(['middleware' => 'can:manage_activetickets'], function(){
    //Live Tickets
    Route::get('livetickets', [AdminController::class,'liveTickets'])->name('livetickets');
    //Get Live Tickets  
    Route::get('getlivetickets', [AdminController::class,'getLiveTickets'])->name('getlivetickets');

    //OpenTickets Tab
    Route::get('openticket', [AdminController::class,'openTicket'])->name('openticket');

    //Work in Progress Tickets Tab
    Route::get('workinprogress', [AdminController::class,'workinprogress'])->name('workinprogress');

    //CloseTickets Tab
    Route::get('CloseTicket', [AdminController::class,'closeTicket'])->name('CloseTicket');

});

Route::group(['middleware' => 'can:support_bucket|pm_bucket|management_bucket'], function(){
    //Store Ticket in Admin database.
    
});

//User Management Access
Route::group(['middleware' => 'can:manage_users'], function(){
   
    //Permission Register Form
    Route::get('registerpermission', function () {
        return view('permission_form');
    })->name('registerpermission');
    // Permisson Create
    Route::post('permission/create', [PermissionsController::class,'createPermission'])->name('permission/create');
    //Permission Table
    Route::get('permission_table', [PermissionsController::class,'permissionTable'])->name('permission_table');
    //Edit Permission
    Route::get('permission/edit/{id}', [PermissionsController::class,'editPermission'])->name('permission/edit/{id}');
    Route::post('permission/update/{id}', [PermissionsController::class,'updatePermission'])->name('permission/update/{id}');


    //Role Register Form
    Route::get('registerrole', [RolesController::class,'indexRole'])->name('registerrole');
    // Role Create
    Route::post('role/create', [RolesController::class,'createRole'])->name('role/create');
    //Role Table
    Route::get('role_table', [RolesController::class,'roleTable'])->name('role_table');


    //User Registration Form
    Route::get('regsiteruser', [UserController::class,'indexUser'])->name('regsiteruser');
    //User Create
    Route::post('storeuser', [UserController::class,'createUser'])->name('storeuser');
    //Users Table
    Route::get('users', [UserController::class,'userTable'])->name('users');


});

//TicketDetail Page
Route::get('ticketdetail/{id}', [AdminController::class,'ticketDetail'])->name('ticketdetail');

//Update Tickets
Route::post('UpdateTicket', [AdminController::class,'updateTicket'])->name('UpdateTicket');

//Email Trigger
Route::get('mail', [AdminController::class,'send_email']);

//Ticket Progress 
Route::get('showprogress/{ticket_id}',[AdminController::class,'getProgress'])->name('showprogress');

//Ticket Form
Route::get('ticketform', function () {
    return view('ticketForm');
})->name('ticketform');

//Ticket Submit
Route::post('TicketSubmit', [AdminController::class,'ticketSubmit'])->name('TicketSubmit');

//My QnA Tickets
Route::get('myopentickets', [AdminController::class,'getUserOpenTickets'])->name('myopentickets');

Route::post('myticket/update', [AdminController::class,'updateMyTicket'])->name('myticket/update');

Route::get('myinprogresstickets', [AdminController::class,'getUserInProgressTickets'])->name('myinprogresstickets');

Route::post('myticket/PushQnA', [AdminController::class,'pushQnA'])->name('myticket/PushQnA');

Route::get('myQnAtickets', [AdminController::class,'getUserQnATickets'])->name('myQnAtickets');

//Get User Details
Route::get('get-userdetails', [UserController::class,'getUser'])->name('get-userdetails');

Route::get('QnATickets', [AdminController::class,'getAssignedQnATickets'])->name('QnATickets');




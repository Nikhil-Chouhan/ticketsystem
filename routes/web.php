<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ManageTicketsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\MyTicketsController;
use App\Http\Controllers\TesterController;
use App\Http\Controllers\DepartmentController;
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

//TicketForm URL Generation
Route::get('GetFormLink/{branchcode}',[TicketController::class,'getFormLink']);

Route::group(['middleware' => ['guest']], function() {

    //Login Routes
    Route::get('loginshow', [LoginController::class,'show'])->name('loginshow');
    Route::post('loginpost', [LoginController::class,'login'])->name('loginpost');

});

Route::group(['middleware' => ['auth']], function() {

    Route::get('dashboard', [AdminController::class,'getdashboard'])->name('dashboard');

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
    Route::get('getCompanyDetails', [CompanyController::class,'getCompanyDetails']);

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

    Route::get('departmentregister', function () {
        return view('department_form');
    });

    Route::post('department/create', [DepartmentController::class,'saveDepartment'])->name('department/create');

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

    //Department Master
    Route::get('departmentmaster', [DepartmentController::class,'departmentMaster'])->name('departmentmaster');
    Route::get('editdepartment/{id}', [DepartmentController::class,'departmentEdit'])->name('editdepartment/{id}');
    Route::post('updatedepartment/{id}', [DepartmentController::class,'departmentUpdate'])->name('updatedepartment/{id}');
    Route::get('department/delete/{id}', [DepartmentController::class,'departmentDelete'])->name('department/delete/{id}');

});

//Support Bucket Access
Route::group(['middleware' => 'can:support_bucket'], function(){
    Route::get('supportbucket', [BucketController::class,'supportBucket'])->name('supportbucket');
    Route::post('ticketstore', [BucketController::class,'ticketStore']);
});
//PM Bucket Access
Route::group(['middleware' => 'can:pm_bucket'], function(){
    Route::get('pmbucket', [BucketController::class,'pmBucket'])->name('pmbucket');
});
//Support Management Access
Route::group(['middleware' => 'can:management_bucket'], function(){
    Route::get('managementbucket', [BucketController::class,'managementBucket'])->name('managementbucket');
});

Route::group(['middleware' => 'can:manage_activetickets'], function(){
    //Live Tickets
    Route::get('livetickets', [ManageTicketsController::class,'liveTicketsView'])->name('livetickets');
    Route::get('liveticketstable', [ManageTicketsController::class,'liveTickets'])->name('liveticketstable');
    //Get Live Tickets  
    Route::get('getlivetickets', [ManageTicketsController::class,'getLiveTickets'])->name('getlivetickets');

    //OpenTickets Tab
    Route::get('openticket', [AdminController::class,'openTicket'])->name('openticket');

    //Work in Progress Tickets Tab
    Route::get('workinprogress', [AdminController::class,'workinprogress'])->name('workinprogress');

    //Approve QnA Tickets Tab
    Route::get('approveQnA', [ManageTicketsController::class,'approveQnA'])->name('approveQnA');

    //QnA Tickets Tab
    Route::get('inQnA', [ManageTicketsController::class,'inQnA'])->name('inQnA');
    //Failed QnA Tickets Tab
    Route::get('failedQnA', [ManageTicketsController::class,'failedQnA'])->name('failedQnA');
    
    Route::post('ticket/update', [ManageTicketsController::class,'updateTicket'])->name('ticket/update');
    
    //CloseTickets Tab
    Route::get('CloseTicket', [ManageTicketsController::class,'closeTicket'])->name('CloseTicket');

});

Route::group(['middleware' => 'can:manage_testing'], function(){
    
    Route::get('QnATickets', [TesterController::class,'getAssignedQnATickets'])->name('QnATickets');
    Route::get('QnAPassTickets', [TesterController::class,'getPassQnATickets'])->name('QnAPassTickets');
    Route::get('QnAfailTickets', [TesterController::class,'getTesterFailQnA'])->name('QnAfailTickets');

});

Route::group(['middleware' => 'can:manage_mytickets'], function(){
    //My Open Tickets
    Route::get('mydepartmenttickets', [MyTicketsController::class,'myDepartmentTickets'])->name('mydepartmenttickets');

    //My Open Tickets
    Route::get('myopentickets', [MyTicketsController::class,'getUserOpenTickets'])->name('myopentickets');

    //My Work in Progress Tickets
    Route::get('myinprogresstickets', [MyTicketsController::class,'getUserInProgressTickets'])->name('myinprogresstickets');

    //My Pushto QnA Tickets
    Route::post('myticket/PushQnA', [AdminController::class,'pushQnA'])->name('myticket/PushQnA');

    //My in QnA Tickets
    Route::get('myQnAtickets', [MyTicketsController::class,'getUserQnATickets'])->name('myQnAtickets');

    //My Failed QnA Tickets
    Route::get('myFailedQnAtickets', [MyTicketsController::class,'getFailedQna'])->name('myFailedQnAtickets');
});


//User Management Access
Route::group(['middleware' => 'can:manage_users'], function(){
   
    //Permission Register Form
    Route::get('registerpermission', function () {
        return view('permission_form');
    })->name('registerpermission');
    
    //Permission Table
    Route::get('permissionmaster', [PermissionsController::class,'masterPermission'])->name('permissionmaster');
    
    // Permisson Create
    Route::post('permission/create', [PermissionsController::class,'createPermission'])->name('permission/create');
    //Edit Permission
    Route::get('permission/edit/{id}', [PermissionsController::class,'editPermission'])->name('permission/edit/{id}');
    Route::post('permission/update/{id}', [PermissionsController::class,'updatePermission'])->name('permission/update/{id}');


    //Role Master
    Route::get('rolemaster', [RolesController::class,'masterRole'])->name('rolemaster');
    //Role Register Form
    Route::get('registerrole', [RolesController::class,'indexRole'])->name('registerrole');
    // Role Create
    Route::post('role/create', [RolesController::class,'createRole'])->name('role/create');
    //Role Edit
    Route::get('role/edit/{id}', [RolesController::class,'editRole'])->name('role/edit/{id}');
    // Role Update
    Route::post('role/update/{id}', [RolesController::class,'updateRole'])->name('role/update/{id}');

    //User Registration Form
    Route::get('registeruser', [UserController::class,'indexUser'])->name('registeruser');
    //User Create
    Route::post('storeuser', [UserController::class,'createUser'])->name('storeuser');
    //Users Table
    Route::get('users', [UserController::class,'userTable'])->name('users');
    //User Edit
    Route::get('user/edit/{id}', [UserController::class,'editUser'])->name('user/edit/{id}');
    // User Update
    Route::post('user/update/{id}', [UserController::class,'updateUser'])->name('user/update/{id}');
});
//raise ticket from panel
Route::get('generateticket', [TicketController::class,'generateTicketForm']);

//Update Tickets
Route::post('generateticket', [TicketController::class,'generateTicket'])->name('generateticket');

//TicketDetail Page
Route::get('ticketdetail/{id}', [AdminController::class,'ticketDetail'])->name('ticketdetail');

//Update Tickets
Route::post('UpdateTicket', [AdminController::class,'updateTicket'])->name('UpdateTicket');

//Ticket Progress 
Route::get('showprogress/{ticket_id}',[AdminController::class,'getProgress'])->name('showprogress');

//Ticket Form
Route::get('ticketform', function () {
    return view('ticketForm');
})->name('ticketform');

//Get Branch Details
Route::get('getbranchdetails', [TicketController::class,'getBranchDetails']);

//Get Branch Details
Route::get('getproductservice', [TicketController::class,'get_ProductService']);

//Ticket Submit
Route::post('TicketSubmit', [TicketController::class,'ticketSubmit'])->name('TicketSubmit');

//Update MyTickets
Route::post('myticket/update', [AdminController::class,'updateMyTicket'])->name('myticket/update');

//Update My Department
Route::post('mydepartment/ticketupdate', [MyTicketsController::class,'updateMydepartment'])->name('mydepartment/ticketupdate');

//Get User Details
Route::get('get-userdetails', [UserController::class,'getUser'])->name('get-userdetails');

//Get Users Department wise 
Route::get('getdepartmentusers', [BucketController::class,'getDepartmentUsers'])->name('getdepartmentusers');

//Set Users Department wise 
Route::get('setUsers', [BucketController::class,'setUsers'])->name('setUsers');
//download Excel
Route::get('downloadexcel/{id}', [AdminController::class,'downloadExcel'])->name('downloadexcel/{id}');


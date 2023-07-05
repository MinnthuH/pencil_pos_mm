<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('welcome_view');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/manage/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('admin.manage')->middleware('permission:admin.manage');

// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin All Roue
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'AdminDestroy')->name('admin#logout'); // admin logout
    Route::get('/logout', 'AdminLogoutPage')->name('admin#logoutpage'); // admin logout page
});

// User Middleware start
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin#profile'); // admin profile page
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('adminProfile#store'); // admin profile store
    Route::get('/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin#changepassword'); // admin profile page
    Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update#password'); // admin profile page

}); //End User Middleware

// Employee All Route
Route::controller(EmployeeController::class)->group(function () {
    Route::get('all/employee', 'AllEmployee')->name('all#employee')->middleware('permission:employee.all'); // all employee page
    Route::get('add/employee', 'AddEmployee')->name('add#employee')->middleware('permission:employee.add'); // add employee page
    Route::post('store/employee', 'StoreEmployee')->name('stroe#employee'); // store employee data
    Route::get('edit/employee/{id}', 'EditEmployee')->name('edit#employee')->middleware('permission:employee.add'); // edit employee data
    Route::post('update/employee', 'UpdateEmployee')->name('update#employee'); // update employee data
    Route::get('delete/employee/{id}', 'DeleteEmployee')->name('delete#employee')->middleware('permission:employee.delete'); // edit employee data

});

// Customer All Route
Route::controller(CustomerController::class)->group(function () {
    Route::get('all/customer', 'AllCustomer')->name('all#customer'); // all customer page
    Route::get('add/customer', 'AddCustomer')->name('add#customer'); // add customer page
    Route::post('store/customer', 'StoreCustomer')->name('stroe#customer'); // store employee data
    Route::get('edit/customer/{id}', 'EditCustomer')->name('edit#customer'); // edit customer data
    Route::post('update/customer', 'UpdateCustomer')->name('update#customer'); // update customer data
    Route::get('delete/customer/{id}', 'DeleteCustomer')->name('delete#customer'); // edit customer data

});

// Supplier All Route
Route::controller(SupplierController::class)->group(function () {
    Route::get('all/supplier', 'AllSupplier')->name('all#supplier'); // all supplier page
    Route::get('add/supplier', 'AddSupplier')->name('add#supplier'); // add supplier page
    Route::post('store/supplier', 'StoreSupplier')->name('stroe#supplier'); // store supplier data
    Route::get('edit/supplier/{id}', 'EditSupplier')->name('edit#supplier'); // edit supplier data
    Route::post('update/supplier', 'UpdateSupplier')->name('update#supplier'); // update supplier data
    Route::get('delete/supplier/{id}', 'DeleteSupplier')->name('delete#supplier'); // edit supplier data
    Route::get('detail/supplier/{id}', 'DetailSupplier')->name('detail#supplier'); // detail supplier data

});

// Advance Salary All Route
Route::controller(SalaryController::class)->group(function () {
    Route::get('add/advance/salary', 'AddAdvSalary')->name('add#advSalary'); // add Advance Salary page
    Route::post('store/advance/salary', 'StoreAdvSalary')->name('store#advsalary'); // add Advance Salary page
    Route::get('all/advance/salary', 'AllAdvSalary')->name('all#advSalary'); // all Advance Salary page
    Route::get('edit/advance/salary/{id}', 'EditAdvSalary')->name('edit#advSalary'); // edit Advance Salary data
    Route::post('update/advance/salary', 'UpdateAdvSalary')->name('update#advsalary'); // update Advance Salary data
    Route::get('delete/advance/salary/{id}', 'DeleteAdvSalary')->name('delete#advSalary'); // edit supplier data

});

// Pay Salary All Route
Route::controller(SalaryController::class)->group(function () {
    Route::get('pay/salary', 'PaySalary')->name('pay#Salary'); // Pay Salary page
    Route::get('pay/now/salary/{id}', 'PayNow')->name('pay#Now'); // Pay Now
    Route::post('paid/salary', 'PaidSalary')->name('paid#Salary'); // Paid Employee Salary store in db
    Route::get('month/salary', 'MonthSalary')->name('month#Salary'); // Month Salary Page

});

// Employee Attendance All Route
Route::controller(AttendanceController::class)->group(function () {
    Route::get('employee/attendance/list', 'AttendanceList')->name('employee#attendance'); // Attendance List
    Route::get('add/attendance', 'AddAttendance')->name('add#attendance'); // Add Attendance
    Route::post('store/employee/attendance/', 'StoreAttendance')->name('store#attendance'); // Store Employee Attendance
    Route::get('edit/attendance/{date}', 'EditAttendance')->name('edit#employeeAttend'); // Edit Attendance Page
    Route::get('view/attendance/{date}', 'ViewAttendance')->name('view#employeeAttend'); // View Attendance Page

});

// Category All Route
Route::controller(CategoryController::class)->group(function () {
    Route::get('all/category', 'AllCategory')->name('all#category'); // All Category route
    Route::post('store/category', 'StoreCategory')->name('store#category'); // store Category route
    Route::get('edit/category/{id}', 'EditCategory')->name('edit#category'); // edit Category route
    Route::post('update/category', 'UpdateCategory')->name('update#category'); // update Category route
    Route::get('delete/category/{id}', 'DeleteCategory')->name('delete#category'); // delete Category route

});

// Product All Route
Route::controller(ProductController::class)->group(function () {
    Route::get('all/product', 'AllProduct')->name('all#product')->middleware('permission:product.menu'); // All product route
    Route::get('add/product', 'AddProduct')->name('add#product'); // add product route
    Route::post('store/porduct', 'StoreProduct')->name('stroe#porduct'); // store product route
    Route::get('edit/product/{id}', 'EditProduct')->name('edit#product'); // edit product route
    Route::post('update/porduct', 'UpdateProduct')->name('update#porduct'); // update product route
    Route::get('delete/product/{id}', 'DeleteProduct')->name('delete#porduct'); // delete product route
    Route::get('code/product/{id}', 'CodeProduct')->name('code#product'); // edit product route
    Route::get('import/product', 'ImportProduct')->name('import#product'); // Import product route
    Route::get('export/product', 'ExportProduct')->name('export#product'); // Exprot product route
    Route::post('import', 'Import')->name('import'); // Import

    ////// Add Stock ////
    Route::post('refill/stock', 'refillStock')->name('refill.stock'); // refill stock

});

// Expense All Route
Route::controller(ExpenseController::class)->group(function () {
    Route::get('add/expense', 'AddExpense')->name('add#expense'); // Add expense
    Route::post('stroe/expense', 'StroeExpense')->name('stroe#expense'); // store expense
    Route::get('today/expense', 'TodayExpense')->name('today#expense'); // Today expense
    Route::get('edit/expense/{id}', 'EditExpense')->name('edit#expense'); // Edit expense
    Route::post('update/expense', 'UpdateExpense')->name('update#expense'); // Update expense

    Route::get('month/expense', 'MonthExpense')->name('month#expense'); // Month expense
    Route::get('year/expense', 'YearExpense')->name('year#expense'); // Year expense

});

// POS All Route
Route::controller(PosController::class)->group(function () {
    Route::get('pos', 'Pos')->name('pos')->middleware('permission:pos.menu'); // Pos page

    Route::get('/category/search/{id}', 'categorySearch'); // Product search with category

    Route::post('/add-cart', 'AddCart'); // Add card
    Route::get('/allitem', 'AllItem'); // All Item
    Route::post('cart_update/{rowId}', 'UpdateCart'); // Update Cart
    Route::get('/cart_remove/{rowId}', 'RemoveCart'); // Remove Item
    Route::post('/create-invoice', 'CreateInvoice'); // Create Invoice

});

// Order All Route
Route::controller(OrderController::class)->group(function () {
    Route::post('/final-invoice', 'FinalInvoice'); // Final Invoice
    Route::get('/panding/order', 'PendingOrder')->name('pending#order'); // Pending Order
    Route::get('/detail/order/{id}', 'DetailOrder')->name('detail#order'); // Detail Order
    Route::post('/update/status-order', 'UpdateStatus')->name('update#status'); // Update status order
    Route::get('/complete/order', 'CompleteOrder')->name('complete#order'); // Complete Order

    Route::get('/manage/stock', 'ManageStock')->name('manage#stock'); // Complete Order
    Route::get('/order/invoice-download/{id}', 'InvoiceDownload'); // Order Invoice Download

    ///// Due All Route////

    Route::get('/pending/due', 'PendingDue')->name('pending#due'); // Pending Due
    Route::get('/order/due/{id}', 'OrderDueAjax'); // Pending Due
    Route::post('/update/due', 'UpdateDue')->name('update#due'); // Update Due

});

// Sale All Route
Route::controller(SaleController::class)->group(function () {
    Route::get('/all/sale', 'allSale')->name('all#sale'); // All Sale
    Route::get('/sale/detail/{id}', 'detailSale')->name('detail#sale'); // Detail Sale
    Route::get('/stock/product/{id}', 'stockProduct')->name('stock#product'); // prodct stock - from pordcut_store from prodcuts
    Route::get('sales/export/daily', 'exportDailySales')->name('sales.export.daily');
    Route::get('sales/export/weekly', 'exportWeeklySales')->name('sales.export.weekly');
    Route::get('sales/export/monthly', 'exportMonthlySales')->name('sales.export.monthly');

});

// Permission All Route
Route::controller(RoleController::class)->group(function () {
    Route::get('/all-permission', 'AllPermission')->name('all#permission'); // All Permissionp
    Route::get('/add-permission', 'AddPermission')->name('add#permission'); // Add Permission
    Route::post('/store-permission', 'StorePermission')->name('store#permission'); // Store Permission
    Route::get('edit/premission/{id}', 'EditPermission')->name('edit#permission'); // edit product route
    Route::post('/update-permission', 'UpdatePermission')->name('update#permission'); // Update Permission
    Route::get('delete/premission/{id}', 'DeletePermission')->name('delete#permission'); // Delete Permission

});

// Role All Route
Route::controller(RoleController::class)->group(function () {
    Route::get('/all-roles', 'AllRoles')->name('all#roles'); // All Roles
    Route::get('/add-roles', 'AddRoles')->name('add#roles'); // Add Roles
    Route::post('/store-role', 'StoreRole')->name('store#role'); // Store Roles
    Route::get('edit/roles/{id}', 'EditRoles')->name('edit#roles'); // edit role route
    Route::post('/update-roles', 'UpdateRoles')->name('update#role'); // Update Role
    Route::get('delete/role/{id}', 'DeleteRole')->name('delete#role'); // Delete Role

});
// Add Role in Permission All Route
Route::controller(RoleController::class)->group(function () {
    Route::get('/add/roles/permission', 'AddRolesPermission')->name('add#rolepermission'); // All Roles
    Route::post('/store/roles/permission', 'StoreRolesPermission')->name('store#rolepermission'); // Store Roles Parmassion
    Route::get('/all/roles/permission', 'AllRolesPermission')->name('all#rolepermission'); // All Roles Parmassion
    Route::get('/edit/roles/permission/{id}', 'EditRolesPermission')->name('adminedit#rolepermission'); // Edit Roles Parmassion
    Route::post('/update/roles/permission/{id}', 'UpdateRolePermission')->name('update#rolepermission'); // Update Role Permission
    Route::get('/delete/roles/permission/{id}', 'DeleteRolePermission')->name('admindelete#permission'); // Delete Role Permission

});

// All Admin Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/all/admin', 'AllAdmin')->name('all#admin'); // All Admin
    Route::get('/add/admin', 'AddAdmin')->name('add#admin'); // Add Admin
    Route::post('/stroe/admin', 'StroeAdmin')->name('stroe#admin'); // Add Admin
    Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit#admin'); // Add Admin
    Route::post('/update/admin', 'UpdateAdmin')->name('update#admin'); // Update Admin
    Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete#admin'); // delete Admin

    // Database Backup Route
    Route::get('/database/backup', 'DatabaseBackup')->name('backup#database'); // All Admin
    Route::get('/backup/now', 'BackupNow'); // Backup
    Route::get('{getFilename}', 'DownloadDb'); // Download
    Route::get('delete/database/{getFilename}', 'DeleteDb'); // Delete Database

});

require __DIR__ . '/auth.php';

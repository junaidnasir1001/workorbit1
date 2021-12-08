<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['guest:admin']], function () {

    Route::get('/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'checkLogin'])->name('login.check');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:admin']], function () {

    Route::post('/logout', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'adminLogout'])->name('logout');

    Route::get('/', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('home');
    Route::resource('client', \App\Http\Controllers\Admin\ClientsController::class);
    Route::post('/client-list', [\App\Http\Controllers\Admin\ClientsController::class, 'showData'])->name('client.list');
    Route::get('/client-notes-list/{client}', [\App\Http\Controllers\Admin\ClientsController::class, 'notesList'])->name('client.notes.list');
    Route::post('/save-client-notes/{client}', [\App\Http\Controllers\Admin\ClientsController::class, 'saveNotes'])->name('client.notes.save');
    Route::post('/delete-client-notes', [\App\Http\Controllers\Admin\ClientsController::class, 'deleteNotes'])->name('client.notes.delete');

    //===================
    Route::get('/sub_contractor-notes-list/{sub_contractor}', [\App\Http\Controllers\Admin\SubContractorController::class, 'notesList'])->name('sub_contractor.notes.list');
    Route::post('/save-sub_contractor-notes/{sub_contractor}', [\App\Http\Controllers\Admin\SubContractorController::class, 'saveNotes'])->name('sub_contractor.notes.save');
    Route::post('/delete-sub_contractor-notes', [\App\Http\Controllers\Admin\SubContractorController::class, 'deleteNotes'])->name('sub_contractor.notes.delete');


    Route::resource('sub_contractor.document', \App\Http\Controllers\Admin\SubContractorDocumentController::class);
    Route::get('sub_contractor-document-download/{document}', [\App\Http\Controllers\Admin\SubContractorDocumentController::class, 'download'])->name('sub_contractor.document.download');


    Route::resource('site_type', \App\Http\Controllers\Admin\SiteTypeController::class);
    Route::post('/site-type-list', [\App\Http\Controllers\Admin\SiteTypeController::class, 'showData'])->name('site_type.list');

    Route::resource('site', \App\Http\Controllers\Admin\SiteController::class);
    Route::post('/site-list', [\App\Http\Controllers\Admin\SiteController::class, 'showData'])->name('site.list');
    Route::resource('site.note', \App\Http\Controllers\Admin\SiteNoteController::class);

    Route::resource('site.contact_person', \App\Http\Controllers\Admin\SiteContactPersonController::class);
    Route::resource('site.document', \App\Http\Controllers\Admin\SiteDocumentController::class);
    Route::get('site-document-download/{document}', [\App\Http\Controllers\Admin\SiteDocumentController::class, 'download'])->name('site.document.download');

    Route::resource('sub_contractor', \App\Http\Controllers\Admin\SubContractorController::class);
    Route::post('/subcontractor-list', [\App\Http\Controllers\Admin\SubContractorController::class, 'showData'])->name('sub_contractor.list');

    Route::resource('designation', \App\Http\Controllers\Admin\DesignationController::class);
    Route::post('/designation-list', [\App\Http\Controllers\Admin\DesignationController::class, 'showData'])->name('designation.list');

    Route::resource('staff', \App\Http\Controllers\Admin\StaffController::class);
    Route::post('/staff-list', [\App\Http\Controllers\Admin\StaffController::class, 'showData'])->name('staff.list');
    Route::get('/staff-notes-list/{staff}', [\App\Http\Controllers\Admin\StaffController::class, 'notesList'])->name('staff.notes.list');
    Route::post('/save-staff-notes/{staff}', [\App\Http\Controllers\Admin\StaffController::class, 'saveNotes'])->name('staff.notes.save');
    Route::post('/delete-staff-notes', [\App\Http\Controllers\Admin\StaffController::class, 'deleteNotes'])->name('staff.notes.delete');

    Route::resource('{staff}/staff_details', \App\Http\Controllers\Admin\StaffDetailsController::class);

    Route::resource('{staff}/bank_details', \App\Http\Controllers\Admin\StaffBankDetailsController::class);

    Route::resource('{staff}/staff_passport', \App\Http\Controllers\Admin\StaffPassportController::class);

    Route::resource('{staff}/staff_emergency_contact', \App\Http\Controllers\Admin\StaffEmergencyContactController::class);
    Route::post('{staff}/emergency-contact-list', [\App\Http\Controllers\Admin\StaffEmergencyContactController::class, 'showData'])->name('staff_emergency_contact.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('{staff}/staff_certificate', \App\Http\Controllers\Admin\StaffCertificateController::class);
    Route::post('{staff}/certificate-list', [\App\Http\Controllers\Admin\StaffCertificateController::class, 'showData'])->name('staff_certificate.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('{staff}/staff_certificate', \App\Http\Controllers\Admin\StaffCertificateController::class);
    Route::post('{staff}/certificate-list', [\App\Http\Controllers\Admin\StaffCertificateController::class, 'showData'])->name('staff_certificate.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('{staff}/staff_training', \App\Http\Controllers\Admin\StaffTrainingController::class);
    Route::post('{staff}/training-list', [\App\Http\Controllers\Admin\StaffTrainingController::class, 'showData'])->name('staff_training.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('{staff}/staff_employment', \App\Http\Controllers\Admin\StaffEmploymentController::class);
    Route::post('{staff}/employment-list', [\App\Http\Controllers\Admin\StaffEmploymentController::class, 'showData'])->name('staff_employment.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('{staff}/staff_education', \App\Http\Controllers\Admin\StaffEducationController::class);
    Route::post('{staff}/education-list', [\App\Http\Controllers\Admin\StaffEducationController::class, 'showData'])->name('staff_education.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('{staff}/staff_personal_reference', \App\Http\Controllers\Admin\StaffPersonalReferenceController::class);
    Route::post('{staff}/personal_reference-list', [\App\Http\Controllers\Admin\StaffPersonalReferenceController::class, 'showData'])->name('staff_personal_reference.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('{staff}/staff_health_information', \App\Http\Controllers\Admin\StaffHealthInformationController::class);

    Route::resource('{staff}/staff_appearance', \App\Http\Controllers\Admin\StaffAppearanceController::class);

    Route::resource('client.contact_person', \App\Http\Controllers\Admin\ClientContactPersonController::class);
    Route::post('contact-person-list', [\App\Http\Controllers\Admin\ClientContactPersonController::class, 'showData'])->name('client.contact_person.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('client.document', \App\Http\Controllers\Admin\ClientDocumentController::class);
    Route::post('document-list', [\App\Http\Controllers\Admin\ClientDocumentController::class, 'showData'])->name('client.document.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::get('client-document-download/{document}', [\App\Http\Controllers\Admin\ClientDocumentController::class, 'download'])->name('client.document.download');

    Route::resource('staff.contact_person', \App\Http\Controllers\Admin\StaffContactPersonController::class);
    Route::post('staff-contact-person-list', [\App\Http\Controllers\Admin\StaffContactPersonController::class, 'showData'])->name('staff.contact_person.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('staff.document', \App\Http\Controllers\Admin\StaffDocumentController::class);
    Route::post('staff-document-list', [\App\Http\Controllers\Admin\StaffDocumentController::class, 'showData'])->name('staff.document.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::get('staff-document-download/{document}', [\App\Http\Controllers\Admin\StaffDocumentController::class, 'download'])->name('staff.document.download')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);


    Route::resource('shift', \App\Http\Controllers\Admin\ShiftController::class);
    Route::post('/shift-list', [\App\Http\Controllers\Admin\ShiftController::class, 'showData'])->name('shift.list');

    Route::get('client-report', [\App\Http\Controllers\Admin\Reports\ClientReportController::class, 'index'])->name('report.client');
    Route::post('/client-report-list', [\App\Http\Controllers\Admin\Reports\ClientReportController::class, 'showData'])->name('report.client.list');

    Route::get('subcontractor-report', [\App\Http\Controllers\Admin\Reports\SubContractorReportController::class, 'index'])->name('report.subcontractor');
    Route::post('/subcontractor-report-list', [\App\Http\Controllers\Admin\Reports\SubContractorReportController::class, 'showData'])->name('report.subcontractor.list');

    Route::get('site-report', [\App\Http\Controllers\Admin\Reports\SiteReportController::class, 'index'])->name('report.site');

    Route::get('staff-report', [\App\Http\Controllers\Admin\Reports\StaffReportController::class, 'index'])->name('report.staff');
    Route::post('/site-report', [\App\Http\Controllers\Admin\Reports\SiteReportController::class, 'showData'])->name('report.site');
    Route::post('/subcontractor-report', [\App\Http\Controllers\Admin\Reports\SubContractorReportController::class, 'showData'])->name('report.sub_contractor');
    Route::post('/staff-report', [\App\Http\Controllers\Admin\Reports\StaffReportController::class, 'showData'])->name('report.staff');

    Route::get('today-shift-report', [\App\Http\Controllers\Admin\Reports\ShiftReportController::class, 'index'])->name('report.today.shift');
    Route::post('/today-shift-report-list', [\App\Http\Controllers\Admin\Reports\ShiftReportController::class, 'showData'])->name('report.today.shift.list');
    Route::get('shift-detail/{shift}', [\App\Http\Controllers\Admin\Reports\ShiftReportController::class, 'shiftDetails'])->name('report.shift.detail');

    Route::get('total-shift-report', [\App\Http\Controllers\Admin\Reports\ShiftReportController::class, 'totalShift'])->name('report.total.shift');
    Route::post('total-shift-report-list', [\App\Http\Controllers\Admin\Reports\ShiftReportController::class, 'totalShiftList'])->name('report.total.shift.list');

    Route::resource('vetting', \App\Http\Controllers\Admin\VettingController::class);
    Route::post('/vetting-list', [\App\Http\Controllers\Admin\VettingController::class, 'showData'])->name('vetting.list');

    Route::resource('staff.staff_vetting', \App\Http\Controllers\Admin\StaffVettingController::class);
    Route::post('{staff}/staff-vetting-list', [\App\Http\Controllers\Admin\StaffVettingController::class, 'showData'])->name('staff.staff_vetting.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::get('{staff}/vetting-document-download/{staff_vetting}', [\App\Http\Controllers\Admin\StaffVettingController::class, 'download'])->name('staff.staff_vetting.download')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('site.pay_rate_card', \App\Http\Controllers\Admin\SitePayRateCardController::class);

    Route::resource('site.charge_rate_card', \App\Http\Controllers\Admin\SiteChargeRateCardController::class);

    Route::resource('admin_user', \App\Http\Controllers\Admin\AdminController::class);
    Route::post('/admin_user-list', [\App\Http\Controllers\Admin\AdminController::class, 'showData'])->name('admin_user.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('permission', \App\Http\Controllers\Admin\PermissionController::class);
    Route::post('/permission-list', [\App\Http\Controllers\Admin\PermissionController::class, 'showData'])->name('permission.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    Route::get('/permission-checkSlug', [\App\Http\Controllers\Admin\PermissionController::class, 'checkSlug'])->name('permission.checkSlug');

    Route::resource('user_permission', \App\Http\Controllers\Admin\UserPermission::class);
    Route::post('/user_permission-list', [\App\Http\Controllers\Admin\UserPermission::class, 'showData'])->name('user_permission.list')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::resource('prefferd_staff', \App\Http\Controllers\Admin\PrefferdStaffController::class);

});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\MessageFromController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Backend\BaseController;
use App\Http\Controllers\Backend\ClubController;
use App\Http\Controllers\Backend\LinkController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Backend\GroupController;
use App\Http\Controllers\Backend\PopupController;
use App\Http\Controllers\Backend\TeamsController;
use App\Http\Controllers\Backend\AlumniController;
use App\Http\Controllers\Backend\CareerController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ClassesController;
use App\Http\Controllers\Backend\FacultyController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\DownloadController;
use App\Http\Controllers\Backend\AdmissionController;
use App\Http\Controllers\Backend\ContactUsController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\VolunteerController;
use App\Http\Controllers\Backend\AlumniFormController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\DesignationController;
use App\Http\Controllers\Backend\FaqCategoryController;
use App\Http\Controllers\Backend\PublicationController;
use App\Http\Controllers\Backend\AcademicLevelController;
use App\Http\Controllers\Backend\VolunteerFormController;
use App\Http\Controllers\Backend\JobApplicationController;
use App\Http\Controllers\Backend\AwardRecognitionController;
use App\Http\Controllers\Backend\DownloadCategoryController;
use App\Http\Controllers\Backend\DrawerNavigationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\PublicationCategoryController;

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    // permisson routes
    Route::prefix('permission')
        ->name('permission')
        ->middleware('permission:permission')
        ->group(function () {
            Route::get('', [PermissionController::class, 'index'])->name('.index');
            Route::get('permission-data', [PermissionController::class, 'permissionData'])->name('.data');
        });

    // setting routes
    Route::prefix('setting')
        ->name('setting')
        ->middleware('permission:setting')
        ->group(function () {
            Route::get('edit', [SettingController::class, 'edit'])->name('.edit');
            Route::put('udpate', [SettingController::class, 'update'])->name('.update');

            Route::get('get-emails', [SettingController::class, 'getEmails'])->name('.emails');
            Route::get('get-contacts', [SettingController::class, 'getContacts'])->name('.contacts');
        });

    // role routes
    Route::middleware('permission:role')->group(function () {
        Route::resource('role', RoleController::class);
        Route::get('role-data', [RoleController::class, 'roleData'])->name('role.data');
    });

    // user routes
    Route::middleware('permission:user')->group(function () {
        Route::resource('user', UserController::class);
        Route::get('user-data', [UserController::class, 'userData'])->name('user.data');
    });

    // Slider routes
    Route::middleware('permission:slider')->group(function () {
        Route::resource('slider', SliderController::class);
        Route::get('slider-data', [SliderController::class, 'sliderData'])->name('slider.data');
    });

    // Popup routes
    Route::middleware('permission:popup')->group(function () {
        Route::resource('popup', PopupController::class);
        Route::get('popup-data', [PopupController::class, 'popupData'])->name('popup.data');
    });

    // gallery routes
    Route::middleware('permission:gallery')->group(function () {
        Route::resource('gallery', GalleryController::class);
        Route::get('gallery-data', [GalleryController::class, 'galleryData'])->name('gallery.data');
        Route::delete('gallery/{gallery}/images/{index}', [GalleryController::class, 'deleteImage'])->name('gallery.delete');
    });

    // menu routes
    Route::middleware('permission:menu')->group(function () {
        Route::resource('menu', MenuController::class);
    });

    // page routes
    Route::middleware('permission:page')->group(function () {
        Route::resource('page', PageController::class);
        Route::get('page-data', [PageController::class, 'pageData'])->name('page.data');
    });

    // drawer navigation routes
    Route::middleware('permission:drawer navigation')->group(function () {
        Route::resource('drawer-navigation', DrawerNavigationController::class);
        Route::get('drawer-navigation-data', [DrawerNavigationController::class, 'drawerNavigationData'])->name('drawer-navigation.data');
    });

    // department routes
    Route::middleware('permission:department')->group(function () {
        Route::resource('department', DepartmentController::class);
        Route::get('department-data', [DepartmentController::class, 'departmentData'])->name('department.data');
    });

    // designation routes
    Route::middleware('permission:designation')->group(function () {
        Route::resource('designation', DesignationController::class);
        Route::get('designation-data', [DesignationController::class, 'designationData'])->name('designation.data');
    });

    // contact us route
    Route::middleware('permission:contact us')
        ->prefix('contact-crud')
        ->name('contact-us')
        ->group(function () {
            Route::get('', [ContactUsController::class, 'index'])->name('.index');
            Route::get('contact-us-data', [ContactUsController::class, 'contactUsData'])->name('.data');
            Route::get('{contact_crud}/show', [ContactUsController::class, 'show'])->name('.show');

            Route::put('{contact_crud}', [ContactUsController::class, 'update'])->name('.update');
        });

    // Publication routes
    Route::middleware('permission:publication')->group(function () {
        Route::resource('publication', PublicationController::class);
        Route::get('publication-data', [PublicationController::class, 'publicationData'])->name('publication.data');
        Route::delete('publication/{publication}/images/{index}', [PublicationController::class, 'deleteImage'])->name('publication.delete');
    });

    // Publication category routes
    Route::middleware('permission:publication category')->group(function () {
        Route::resource('publication-category', PublicationCategoryController::class);
        Route::get('publication-category-data', [PublicationCategoryController::class, 'publicationCategoryData'])->name('publication-category.data');
    });

    // Classes routes
    Route::middleware('permission:classes')->group(function () {
        Route::resource('classes', ClassesController::class);
        Route::get('classes-data', [ClassesController::class, 'classesData'])->name('classes.data');
    });

    // Subject routes
    Route::middleware('permission:subject')->group(function () {
        Route::resource('subject', SubjectController::class);
        Route::get('subject-data', [SubjectController::class, 'subjectData'])->name('subject.data');
    });

    // Academic Level routes
    Route::middleware('permission:academic level')->group(function () {
        Route::resource('academic-level', AcademicLevelController::class);
        Route::get('academic-level-data', [AcademicLevelController::class, 'academicLevelData'])->name('academic-level.data');
        Route::delete('academic-level/{academic_level}/images/{index}', [AcademicLevelController::class, 'deleteImage'])->name('academic-level.delete');
    });

    // Admission routes
    Route::middleware('permission:admission')->group(function () {
        Route::resource('admission', AdmissionController::class);

        Route::get('admission-data', [AdmissionController::class, 'admissionData'])->name('admission.data');
        Route::delete('admission/{admission}/photo', [AdmissionController::class, 'deletePhoto'])->name('admission.delete-photo');
        Route::delete('admission-parent/{parent}', [AdmissionController::class, 'deleteParent'])->name('admission.delete-parent');
        Route::delete('admission-college-subject/{subject}', [AdmissionController::class, 'deleteCollegeSubject'])->name('admission.delete-college-subject');
        Route::put('admission/{admission}/update-status/{field}', [AdmissionController::class, 'updateStatus'])->name('admission.update-status');
        Route::get('admission/{faculty}/subjects', [AdmissionController::class, 'getSubjectsByFaculty'])->name('admission.getSubjects');
        Route::get('admission/{admission}/download', [AdmissionController::class, 'download'])->name('admission.download');
    });

    // Awards Recognition  routes
    Route::middleware('permission:award & achivements')->group(function () {
        Route::resource('award-recognition', AwardRecognitionController::class);
        Route::get('award-recognition-data', [AwardRecognitionController::class, 'awardRecognitonData'])->name('award-recognition.data');
    });

    // Download category routes
    Route::middleware('permission:download category')->group(function () {
        Route::resource('download-category', DownloadCategoryController::class);
        Route::get('download-category-data', [DownloadCategoryController::class, 'downloadCategoryData'])->name('download-category.data');
    });

    // Download routes
    Route::middleware('permission:download')->group(function () {
        Route::resource('download', DownloadController::class);
        Route::get('download-data', [DownloadController::class, 'downloadData'])->name('download.data');
        Route::delete('download/{download}/download/{index}', [DownloadController::class, 'deleteDocument'])->name('download.delete');
    });

    // Faq category routes
    Route::middleware('permission:faq category')->group(function () {
        Route::resource('faq-category', FaqCategoryController::class);
        Route::get('faq-category-data', [FaqCategoryController::class, 'faqCategoryData'])->name('faq-category.data');
    });

    // Faq routes
    Route::middleware('permission:faq')->group(function () {
        Route::resource('faq', FaqController::class);
        Route::get('faq-data', [FaqController::class, 'faqData'])->name('faq.data');
        Route::delete('faq/{faq}/faq/{index}', [FaqController::class, 'deleteDocument'])->name('faq.delete');
    });

    // Faculty routes
    Route::middleware('permission:faculty')->group(function () {
        Route::resource('faculty', FacultyController::class);
        Route::get('faculty-data', [FacultyController::class, 'facultyData'])->name('faculty.data');

        Route::delete('faculty/{faculty}/images/{index}', [FacultyController::class, 'deleteImage'])->name('faculty.delete');
        Route::put('faculty/{faculty}/group-subject', [FacultyController::class, 'facultyGroupSubject'])->name('faculty.group-subject');
    });

    // BeyondAcademic routes
    Route::middleware('permission:beyond academic')->group(function () {
        Route::resource('beyond-academic', ClubController::class);
        Route::get('club-data', [ClubController::class, 'clubData'])->name('beyond-academic.data');
        Route::delete('beyond-academic/{beyond_academic}/images/{index}', [ClubController::class, 'deleteImage'])->name('beyond-academic.delete');
    });

    // Team routes
    Route::middleware('permission:teams')->group(function () {
        Route::resource('team', TeamsController::class);
        Route::get('teams-data', [TeamsController::class, 'teamData'])->name('team.data');
    });

    // Career routes
    Route::middleware('permission:careers')->group(function () {
        Route::resource('career', CareerController::class);
        Route::get('career-data', [CareerController::class, 'careerData'])->name('career.data');
    });

    Route::middleware('permission:job application')->group(function () {
        Route::resource('job-application', JobApplicationController::class);
        Route::get('job-application-data', [JobApplicationController::class, 'jobApplicationData'])->name('job-application.data');
        Route::put('job-application/{id}/update-scanned-status', [JobApplicationController::class, 'markAsScanned'])->name('job-application.update-scanned-status');
        Route::put('job-application/{id}/update-shortlisted-status', [JobApplicationController::class, 'markAsShortlisted'])->name('job-application.update-shortlisted-status');

        Route::get('excel-export/job-application', [JobApplicationController::class, 'excelExport'])->name('job-application.excel-export');
    });

    // Volunter Form routes
    Route::middleware('permission:volunteer form')->group(function () {
        Route::resource('volunteer-form', VolunteerFormController::class);
        Route::get('volunteer-form-data', [VolunteerFormController::class, 'volunteerFormData'])->name('volunteer-form.data');
        Route::put('volunteer-form/{id}/update-scanned-status', [VolunteerFormController::class, 'markAsScanned'])->name('volunteer-form.update-scanned-status');
        Route::put('volunteer-form/{id}/update-shortlisted-status', [VolunteerFormController::class, 'markAsShortlisted'])->name('volunteer-form.update-shortlisted-status');
    });

    // Volunter routes
    Route::middleware('permission:volunteer')
        ->prefix('volunteer-crud')
        ->name('volunteer')
        ->group(function () {
            Route::get('edit', [VolunteerController::class, 'edit'])->name('.edit');
            Route::put('udpate', [VolunteerController::class, 'update'])->name('.update');

            Route::delete('{volunteer}/images/{index}', [VolunteerController::class, 'deleteImage'])->name('.delete');
        });

    // Alumni routes
    Route::middleware('permission:alumni')
        ->prefix('alumni-crud')
        ->name('alumni')
        ->group(function () {
            Route::get('edit', [AlumniController::class, 'edit'])->name('.edit');
            Route::put('udpate', [AlumniController::class, 'update'])->name('.update');

            Route::delete('{alumni}/images/{index}', [AlumniController::class, 'deleteImage'])->name('.delete');
            Route::get('get-links', [AlumniController::class, 'getLinks'])->name('.links');
        });

    // Alumni Form routes
    Route::middleware('permission:alumni form')->group(function () {
        Route::resource('alumni-form', AlumniFormController::class);
        Route::get('alumni-form-data', [AlumniFormController::class, 'alumniFormData'])->name('alumni-form.data');
    });

    // link routes
    Route::middleware('permission:link')->group(function () {
        Route::resource('link', LinkController::class);
        Route::get('link-data', [LinkController::class, 'linkData'])->name('link.data');
    });

    // group routes
    Route::middleware('permission:group')->group(function () {
        Route::resource('group', GroupController::class);
        Route::get('group-data', [GroupController::class, 'groupData'])->name('group.data');
    });

    // message from routes
    Route::middleware('permission:founder and principal')
        ->name('message-from.')
        ->group(function () {
            Route::get('message-from', [MessageFromController::class, 'index'])->name('index');
            Route::get('message-from/{message_from:slug}/edit', [MessageFromController::class, 'edit'])->name('edit');
            Route::put('message-from/{message_from}', [MessageFromController::class, 'update'])->name('update');
        });

    // Statistics routes
    Route::middleware('permission:statistics')->group(function () {
        Route::resource('statistic', StatisticsController::class);
        Route::get('statistic-data', [StatisticsController::class, 'statisticsData'])->name('statistic.data');
    });

    // About us routes
    Route::middleware('permission:about us')
        ->prefix('aboutus')
        ->name('aboutus')
        ->group(function () {
            Route::get('edit', [AboutUsController::class, 'edit'])->name('.edit');

            Route::put('udpate', [AboutUsController::class, 'updateAboutUs'])->name('.update-about-us');

            Route::put('udpate/cronology', [AboutUsController::class, 'updateCronology'])->name('.update-cronology');
            Route::get('cronology-detail', [AboutUsController::class, 'getCronologyDetail'])->name('.get-cronology-detail');

            Route::put('udpate/card', [AboutUsController::class, 'updateCard'])->name('.update-card');
            Route::get('card-detail', [AboutUsController::class, 'getCardDetail'])->name('.get-card-detail');
        });

    // testimonial routes
    Route::middleware('permission:testimonial')->group(function () {
        Route::resource('testimonial', TestimonialController::class);
        Route::get('testimonial-data', [TestimonialController::class, 'testimonialData'])->name('testimonial.data');
    });

    // Subscription routes
    Route::middleware('permission:subscription')->group(function () {
        Route::resource('subscription', SubscriptionController::class);
        Route::get('subscription-data', [SubscriptionController::class, 'subscriptionData'])->name('subscription.data');

        Route::get('excel-export/subscription', [SubscriptionController::class, 'excelExport'])->name('subscription.excel-export');
    });

    Route::put('update-is-active/{id}/{model}', [BaseController::class, 'updateIsActive'])->name('update-is-active');
    Route::put('update-is-published/{id}/{model}', [BaseController::class, 'updateIsPublished'])->name('update-is-published');

    // profile
    Route::prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('', [ProfileController::class, 'update'])->name('update');
        });

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

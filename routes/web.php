<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Frontend\CareerController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\AlumniFormController;
use App\Http\Controllers\Frontend\VolunteerFormController;
use App\Http\Controllers\Frontend\OnlineAdmissionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('language')->group(function () {
    Route::get('/', [FrontendController::class, 'homepage'])->name('home');
    Route::get('/home', [FrontendController::class, 'homepage'])->name('home');

    Route::get('/school-profile', [FrontendController::class, 'aboutUs'])->name('about-us');
    Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about-us');

    Route::get('/his-excellency-late-gyan-bahadur-yakthumba', [FrontendController::class, 'lateGyanBahadurYakthumba'])->name('late-gyan-bahadur-yakthumba');
    Route::get('/founder-principal', [FrontendController::class, 'founderPrincipal'])->name('founder-principal');
    Route::get('/vice-principal', [FrontendController::class, 'vicePrincipal'])->name('vice-principal');
    Route::get('/executive-director', [FrontendController::class, 'executiveDirector'])->name('executive-director');

    Route::get('/facilities', [FrontendController::class, 'facilityPage'])->name('facility');
    Route::get('/facilities/{slug?}', [FrontendController::class, 'facilityDetail'])->name('facility-detail');

    Route::get('/club-eca', [FrontendController::class, 'clubPage'])->name('clubs');
    Route::get('/club-eca/{slug?}', [FrontendController::class, 'clubDetail'])->name('club-detail');

    Route::get('/usp', [FrontendController::class, 'uspPage'])->name('usps');
    Route::get('/usp-detail/{slug?}', [FrontendController::class, 'uspDetail'])->name('usp-detail');

    Route::get('/downloads', [FrontendController::class, 'downloads'])->name('downloads');

    Route::get('/academic-levels', [FrontendController::class, 'academics'])->name('academics');
    Route::get('/academic-levels/higher-secondary', [FrontendController::class, 'higherSecondaryDetail'])->name('higher-secondary');

    Route::get('/academic-levels/{slug?}', [FrontendController::class, 'academicsDetail'])->name('academics-detail');

    // volunteer
    Route::prefix('volunteer')
        ->name('volunteer-page')
        ->group(function () {
            Route::get('', [VolunteerFormController::class, 'volunteerPage'])->name('.show');
            Route::post('', [VolunteerFormController::class, 'store'])->name('.store');
        });

    Route::get('careers', [CareerController::class, 'careerPage'])->name('career');
    Route::prefix('career-details')
        ->name('career-details')
        ->group(function () {
            Route::get('/{slug?}', [CareerController::class, 'careerDetails'])->name('.show');
            Route::post('', [CareerController::class, 'store'])->name('.store');
        });

    Route::get('/contact-us', [ContactUsController::class, 'contact'])->name('contact');
    Route::post('/contact-us', [ContactUsController::class, 'storeContact'])->name('store-contact');

    Route::get('/quick-links', [FrontendController::class, 'quicklink'])->name('quick-link');

    Route::get('/faqs', [FrontendController::class, 'listFaqCategory'])->name('faqs');
    Route::get('/faqs/{faq_category}', [FrontendController::class, 'getFaqs'])->name('get-faq');

    Route::get('/galleries', [FrontendController::class, 'gallery'])->name('gallery');
    Route::get('/galleries/{slug?}', [FrontendController::class, 'galleryDetail'])->name('gallery-detail');

    Route::get('/teams', [FrontendController::class, 'team'])->name('team');

    Route::get('/publications', [FrontendController::class, 'publication'])->name('publication');
    Route::get('/publications/{slug}', [FrontendController::class, 'publicationDetail'])->name('publication-detail');

    Route::get('site-map', [FrontendController::class, 'siteMap'])->name('site-map');

    Route::get('privacy-statement', [FrontendController::class, 'privacyStatement'])->name('privacy-statement');
    Route::get('terms-and-conditions', [FrontendController::class, 'termsAndCondition'])->name('terms-and-condition');

    Route::prefix('alumni')
        ->name('alumni')
        ->group(function () {
            Route::get('/', [AlumniFormController::class, 'alumni'])->name('.alumni');
            Route::post('/', [AlumniFormController::class, 'store'])->name('.store');
        });


    Route::get('/awards', [FrontendController::class, 'awards'])->name('awards');
    Route::get('/achievements', [FrontendController::class, 'achievements'])->name('achievements');

    Route::get('/testimonials', [FrontendController::class, 'testimonials'])->name('testimonials');

    // online admission for school and college level
    // Route::get('/admission-procedure', [OnlineAdmissionController::class, 'admissionProcedure'])->name('online-admission.procedure');
    Route::get('admission/school-level', [OnlineAdmissionController::class, 'schoolLevel'])->name('online-admission.school-level');
    Route::post('admission/school-level/store', [OnlineAdmissionController::class, 'storeSchoolLevel'])->name('online-admission.school-level-store');
    Route::get('admission/2-level', [OnlineAdmissionController::class, 'collegeLevel'])->name('online-admission.college-level');
    Route::post('admission/2-level/store', [OnlineAdmissionController::class, 'storeCollegeLevel'])->name('online-admission.college-level-store');

    Route::post('news-letter-subscription', [FrontendController::class, 'storeSubscription'])->name('news-letter.subscription');
});

Route::get('lang/{lang}', LanguageController::class)->name('locale');

require __DIR__ . '/auth.php';

Route::middleware('language')->group(
    function () {
        Route::get('{slug}', [FrontendController::class, 'pageBuilder'])->name('page-builder');
    }
);

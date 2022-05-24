<?php

use App\Http\Controllers\Client\TestimonialController;
use Illuminate\Support\Facades\Route;

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

Route::post('/contact_form_submit', [App\Http\Controllers\HomeController::class, 'contactFormSubmit'])
    ->name('contact.submit');

Route::get('landingform/{id}', [App\Http\Controllers\HomeController::class, 'landingForm'])
    ->name('get_landing_form');

Route::post('submit_form/{id}', [App\Http\Controllers\FormController::class, 'submitForm'])
    ->name('submit_landing_form');

Route::post('increase_view_count/{id}', [App\Http\Controllers\HomeController::class, 'landingPageVisited'])
    ->name('increase_view_count');

$appRoutes = function () {
    Auth::routes(['verify' => true]);
    Route::auth();
    Route::get('/', [App\Http\Controllers\PagesController::class, 'home'])->name('homepage');
    Route::get('/pages/{slug}', [App\Http\Controllers\PagesController::class, 'pages'])->name('pages');
    Route::namespace ('App\Http\Controllers\Client')
        ->middleware(['auth', 'verified', 'role:client|admin', 'checkStatus'])
        ->as('client.')
        ->prefix('client')
        ->group(function () {

            Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

            //  update profile
            Route::put('profile/change_password', [App\Http\Controllers\Client\ProfileController::class, 'changePassword'])->name('profile.change_password');

            // update company info
            Route::put('profile/update_company_info', [App\Http\Controllers\Client\ProfileController::class, 'updateCompanyInfo'])->name('profile.update_company_info');

            // profile management
            Route::resource('profile', ProfileController::class);

            // landing management
            Route::group(['middleware' => ['can:view_landings']], function () {
                //landing page template
                Route::get('landing/template/{id}', [App\Http\Controllers\Client\LandingController::class, 'selectTemplate'])
                    ->name('landing.select_template');

                // store landing template
                Route::post('landing/template_save', [App\Http\Controllers\Client\LandingController::class, 'saveTemplate'])
                    ->name('landing.save_template');

                //Edit landing page template
                Route::get('landing/edit_template/{id}', [App\Http\Controllers\Client\LandingController::class, 'editTemplate'])
                    ->name('landing.edit_template');

                // store landing template data
                Route::post('landing/template_data_save', [App\Http\Controllers\Client\LandingController::class, 'saveTemplateData'])
                    ->name('landing.save_template_data');

                //Edit thankyou page template
                Route::get('landing/edit_thankyou_page/{id}', [App\Http\Controllers\Client\LandingController::class, 'editThankYouPage'])
                    ->name('landing.edit_thankyou_page');
                
                // store landing template data
                Route::post('landing/thankyou_page_data_save', [App\Http\Controllers\Client\LandingController::class, 'saveThankYouPageData'])
                    ->name('landing.save_thankyou_page_data');
                
                // update landing status
                Route::put('landing/update_status/{id}', [App\Http\Controllers\Client\LandingController::class, 'updateStatus'])
                    ->name('landing.update_status')
                    ->middleware('checkLandingsLimit');

                //Inactive Page
                Route::get('landing/maintenance', [App\Http\Controllers\Client\LandingController::class, 'inactivePage'])->name('landing.inactive_page');

                // landing page management
                Route::resource('landing', LandingController::class);

                // Forms management
                Route::resource('forms', LandingFormController::class);
                Route::resource('criteria', CriteriaController::class)->only('update');

                // get domain
                Route::get('/landing/domain/{id}', [App\Http\Controllers\Client\LandingController::class, 'getDomainPage'])
                    ->name('landing.domain');

                Route::put('/landing/domain/{id}', [App\Http\Controllers\Client\LandingController::class, 'saveDomainInformation'])
                    ->name('landing.save.domain');

                // Tracking
                Route::get('/landing/tracking/{id}', [App\Http\Controllers\Client\LandingController::class, 'getTrackingPage'])
                    ->name('landing.tracking');

                Route::put('/landing/tracking/{id}', [App\Http\Controllers\Client\LandingController::class, 'saveTrackingInformation'])
                    ->name('landing.save.tracking');

                // Form submission response tester
                Route::post('landing/test_response', [App\Http\Controllers\Client\LandingFormController::class, 'testResponse'])
                    ->name('landing.test_response');

                // send request to admin
                Route::put('/landing/status/{id}', [App\Http\Controllers\Client\LandingController::class, 'sendRequest'])
                    ->name('landing.set_status');

                //get publish page
                Route::get('/landing/publish/{id}', [App\Http\Controllers\Client\LandingController::class, 'publish'])
                    ->name('landing.publish');

                // publish landing
                Route::put('landing/publish_landing/{id}', [App\Http\Controllers\Client\LandingController::class, 'publishLanding'])
                    ->name('landing.publish_landing');

            });

            Route::get('/report', [App\Http\Controllers\Client\ReportsController::class, 'index'])
                ->name('report.index');

            // campaigns management
            Route::group(['middleware' => ['can:view_campaigns']], function () {
                Route::resource('campaigns', CampaignController::class);
                Route::post('testimonials/store', [\App\Http\Controllers\Client\TestimonialController::class, 'store'])->name('testimonials.store');
                Route::get('/campaign/list', [\App\Http\Controllers\Client\CampaignController::class, 'campaignsList'])->name('campaign.list');
                Route::put('/campaign/status/{id}', [\App\Http\Controllers\Client\CampaignController::class, 'changeStatus'])
                    ->name('campaign.status')->middleware('checkCampaignsLimit');
            });

            // subscriptions management
            Route::group(['middleware' => ['can:view_subscriptions']], function () {
                Route::resource('subscriptions', SubscriptionController::class);
                Route::get('/check/card', [\App\Http\Controllers\Client\SubscriptionController::class, 'checkCardDetails'])->name('check.card');
            });

            // cards management
            Route::group(['middleware' => ['can:view_cards']], function () {
                Route::resource('cards', CardController::class);
            });

            //Helper function for logo
            Route::get('/get-logo', function () {
                return getLogo();
            })->name('get-logo');

        });
    Route::post('sign-in', [App\Http\Controllers\Auth\LoginController::class, 'signIn'])->name('sign-in');

};

// Route::get('sign-in',[ App\Http\Controllers\Auth\LoginController::class , 'signInForm'])->name('sign-in-form');

// Route::get('sign-up',[ App\Http\Controllers\Auth\RegisterController::class , 'signupForm'])->name('signup.form');
// Route::post('sign-up',[ App\Http\Controllers\Auth\RegisterController::class , 'signup'])->name('signup');

Route::group(array('domain' => 'www.' . env('DOMAIN_URL')), $appRoutes);
Route::group(array('domain' => env('DOMAIN_URL')), $appRoutes);

Route::domain('{uuid}.' . env('DOMAIN_URL'))->group(function ($uuid) {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'showLandingPage']);
    Route::get('thankyou', [App\Http\Controllers\FormController::class, 'thankYou'])->name('thankyou');
});

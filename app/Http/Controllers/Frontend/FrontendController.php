<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Club;
use App\Models\Link;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Popup;
use App\Models\Teams;
use App\Enum\ClubEnum;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Faculty;
use App\Models\Gallery;
use App\Models\Setting;
use App\Models\Statistic;
use App\Models\Volunteer;
use App\Models\Department;
use App\Models\AboutUsCard;
use App\Models\Designation;
use App\Models\FaqCategory;
use App\Models\MessageFrom;
use App\Models\Publication;
use App\Models\Testimonial;
use App\Enum\GalleryTypeEnum;
use App\Models\AcademicLevel;
use App\Models\AboutUsCronology;
use App\Models\AwardRecognition;
use App\Models\DownloadCategory;
use App\Enum\MessageFromTypeEnum;
use App\Enum\PerspectiveFromEnum;
use Illuminate\Support\Facades\DB;
use App\Models\PublicationCategory;
use App\Http\Controllers\Controller;
use App\Enum\AwardAchivementTypeEnum;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Frontend\SubscriptionRequest;
use App\Models\Subscription;

class FrontendController extends Controller
{
    public function homepage()
    {
        $quickNavs = Menu::where('is_featured_navigation', true)->published()->displayOrder()->get();
        $usps = Club::where('school_amenity', ClubEnum::UNIQUESELLINGPOINT->value)->published()->featured()->displayOrder()->get();

        $principal = MessageFrom::where('slug', MessageFromTypeEnum::INDIRAYAKTHUMBA->value)->first();
        if ($principal) {
            $infoEn = json_decode($principal->information_en, true);
            $infoNp = json_decode($principal->information_np, true);

            $designation = Designation::find($infoEn['designation_id'] ?? null);

            if ($designation) {
                $infoEn['designation'] = $designation->name_en;
                $infoNp['designation'] = $designation->name_np;
            }

            $principal->information_en = $infoEn;
            $principal->information_np = $infoNp;
        }

        $sliders = Slider::published()->displayOrder()->get();
        $statistics = Statistic::published()->displayOrder()->get();

        $academicLevels = AcademicLevel::featured()->published()->displayOrder()->get();

        $publicationCategory = PublicationCategory::whereIn('id', [1, 2])
            ->published()
            ->with([
                'publications' => function ($query) {
                    $query->published()->latest()->take(4);
                },
            ])
            ->get();

        $galleries = Gallery::published()->featured()->displayOrder()->get();

        $aboutUs = AboutUs::first();

        $awards = AwardRecognition::where('type', AwardAchivementTypeEnum::AWARD->value)->published()->featured()->displayOrder()->get();
        $achivements = AwardRecognition::where('type', AwardAchivementTypeEnum::ACHIVEMENT->value)->published()->featured()->displayOrder()->get();

        $setting = Setting::select('primary_logo', 'school_hour_en', 'school_hour_np', 'description_en', 'description_np')->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(contacts, '$[0]')) as contact1")->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(contacts, '$[1]')) as contact2")->first();

        $testimonials = Testimonial::with(['alumni' => function ($q) {
            $q->published()->displayOrder();
        }])->featured()->get();
        $volunteer = Volunteer::first();

        $today = Carbon::today();
        $popups = Popup::whereDate('publish_date', '<=', $today)
            ->whereDate('publish_upto', '>=', $today)->published()->displayOrder()->get();

        return view('frontend.homepage.homepage', compact(
            'quickNavs',
            'usps',
            'principal',
            'sliders',
            'statistics',
            'academicLevels',
            'publicationCategory',
            'galleries',
            'aboutUs',
            'awards',
            'achivements',
            'setting',
            'testimonials',
            'volunteer',
            'popups',
        ));
    }

    public function aboutUs()
    {
        $aboutUs = AboutUs::first();
        $cronologies = AboutUsCronology::all();
        $cards = AboutUsCard::all();
        $setting = Setting::select('map', 'youtube_video')->first();

        return view('frontend.about-us', compact('aboutUs', 'cronologies', 'cards', 'setting'));
    }

    public function rough()
    {


        return view('frontend.rough');
    }

    public function lateGyanBahadurYakthumba()
    {
        $messageFrom = MessageFrom::where('slug', MessageFromTypeEnum::GYANBAHADURYAKTHUMBA->value)->first();

        return view('frontend.late-gyan-bahadur-yakthumba', compact('messageFrom'));
    }

    public function founderPrincipal()
    {
        $messageFrom = MessageFrom::where('slug', MessageFromTypeEnum::INDIRAYAKTHUMBA->value)->first();

        $infomrationEn = json_decode($messageFrom->information_en ?? '');
        $infomrationNp = json_decode($messageFrom->information_np ?? '');

        if ($infomrationEn) {
            $designation = Designation::where('id', $infomrationEn->designation_id ?? '')
                ->pluck('name_en')
                ->first();
            $infomrationEn->designation_id = $designation;
        }

        if ($infomrationNp) {
            $designation = Designation::where('id', $infomrationNp->designation_id ?? '')
                ->pluck('name_np')
                ->first();
            $infomrationNp->designation_id = $designation;
        }

        $messageFrom->information_en = json_encode($infomrationEn ?? '');
        $messageFrom->information_np = json_encode($infomrationNp ?? '');

        return view('frontend.founder-principal', compact('messageFrom'));
    }

    public function vicePrincipal()
    {
        $vicePrincipal = Teams::with('designation')->where('designation_id', 3)->first();

        return view('frontend.school-heads', compact('vicePrincipal'));
    }

    public function executiveDirector()
    {
        $vicePrincipal = Teams::with('designation')->where('designation_id', 4)->first();

        return view('frontend.school-heads', compact('vicePrincipal'));
    }

    public function facilityPage()
    {
        $facilities = Club::where('school_amenity', ClubEnum::FACILITIES->value)->published()->get();

        return view('frontend.facility.facility', compact('facilities'));
    }

    public function facilityDetail($slug = null)
    {
        if ($slug) {
            $setting = Setting::first();
            $data = Club::where('slug', $slug)->firstOrFail();
            $allDatas = Club::where('school_amenity', ClubEnum::FACILITIES->value)->where('id', '!=', $data->id)->published()->featured()->get();
        }

        $aboutUs = AboutUs::select('description_en', 'description_np')->first();
        $route1 = 'facility';
        $route2 = 'facility-detail';

        return view('frontend.partials.beyond-academics-detail', compact('data', 'allDatas', 'setting', 'aboutUs', 'route1', 'route2'));
    }

    public function clubPage()
    {
        $clubs = Club::where('school_amenity', ClubEnum::CLUB->value)->published()->get();

        return view('frontend.club.club', compact('clubs'));
    }

    public function clubDetail($slug = null)
    {
        if ($slug) {
            $setting = Setting::first();
            $data = Club::where('slug', $slug)->firstOrFail();
            $allDatas = Club::where('school_amenity', ClubEnum::CLUB->value)->where('id', '!=', $data->id)->published()->get();
        }

        $route1 = 'clubs';
        $route2 = 'club-detail';

        return view('frontend.partials.beyond-academics-detail', compact('data', 'allDatas', 'setting', 'route1', 'route2'));
    }

    public function uspPage()
    {
        $usps = Club::where('school_amenity', ClubEnum::UNIQUESELLINGPOINT->value)->published()->get();

        return view('frontend.usp.usp', compact('usps'));
    }

    public function uspDetail($slug = null)
    {
        if ($slug) {
            $setting = Setting::first();
            $data = Club::where('slug', $slug)->firstOrFail();
            $allDatas = Club::where('school_amenity', ClubEnum::UNIQUESELLINGPOINT->value)->where('id', '!=', $data->id)->published()->get();
        }

        $aboutUs = AboutUs::select('description_en', 'description_np')->first();
        $route1 = 'usps';
        $route2 = 'usp-detail';

        return view('frontend.partials.beyond-academics-detail', compact('data', 'allDatas', 'setting', 'route1', 'route2'));
    }

    public function downloads()
    {
        $downloadCategories = DownloadCategory::with([
            'downloads' => function ($query) {
                $query->published()->displayOrder();
            },
        ])
            ->published()
            ->displayOrder()
            ->get();

        return view('frontend.downloads.index', compact('downloadCategories'));
    }

    public function academics()
    {
        $academic = Page::whereId(1)->first();
        $academicLevels = AcademicLevel::with(['classes' => function ($q) {
            $q->published()->displayOrder();
        }])->published()->get();

        return view('frontend.academics', compact('academic', 'academicLevels'));
    }

    public function academicsDetail($slug)
    {
        $academicLevel = AcademicLevel::with(['classes' => function ($q) {
            $q->published()->displayOrder();
        }])->where('slug', $slug)->first();
        $usps = Club::where('school_amenity', ClubEnum::UNIQUESELLINGPOINT->value)->published()->featured()->get();

        return view('frontend.academics-detail', compact('academicLevel', 'usps'));
    }

    public function higherSecondaryDetail()
    {
        $academicLevel = AcademicLevel::with(['classes' => function ($q) {
            $q->published()->displayOrder();
        }])->where('slug', 'higher-secondary')->first();
        $faculties = Faculty::published()->get();


        return view('frontend.college.college-level', compact('academicLevel', 'faculties'));
    }

    public function quicklink()
    {
        $quickLinks = Link::with('menu')->published()->displayOrder()->get()->chunk(6);
        $setting = Setting::select('facebook', 'instagram', 'linkedin', 'x', 'youtube')->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(emails, '$[0]')) as email1")->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(emails, '$[1]')) as email2")->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(contacts, '$[0]')) as contact")->first();

        return view('frontend.quicklink', compact('quickLinks', 'setting'));
    }

    public function listFaqCategory()
    {
        $faqCategories = FaqCategory::published()->get();
        $setting = Setting::select('facebook', 'instagram', 'linkedin', 'x', 'youtube')->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(emails, '$[0]')) as email1")->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(emails, '$[1]')) as email2")->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(contacts, '$[0]')) as contact")->first();

        return view('frontend.faq.faqs', compact('faqCategories', 'setting'));
    }

    public function getFaqs($id)
    {
        $faqs = Faq::published()->where('faq_category_id', $id)->get();
        return view('frontend.faq.getfaq', compact('faqs'));
    }

    public function gallery()
    {
        $imageGalleries = Gallery::where('type', GalleryTypeEnum::IMAGE->value)->published()->displayOrder()->get();
        $videoGalleries = Gallery::where('type', GalleryTypeEnum::VIDEO->value)->published()->displayOrder()->get();

        return view('frontend.gallery.gallery', compact('imageGalleries', 'videoGalleries'));
    }

    public function galleryDetail($slug)
    {
        if ($slug) {
            $gallery = Gallery::where('slug', $slug)->firstOrFail();
        }

        return view('frontend.gallery.gallery-detailed', compact('gallery'));
    }

    public function team()
    {
        $founder = MessageFrom::where('slug', MessageFromTypeEnum::GYANBAHADURYAKTHUMBA->value)->first();

        $principal = MessageFrom::where('slug', MessageFromTypeEnum::INDIRAYAKTHUMBA->value)->first();
        $infomrationEn = json_decode($principal->information_en ?? '');
        $infomrationNp = json_decode($principal->information_np ?? '');

        if ($infomrationEn) {
            $designation = Designation::where('id', $infomrationEn->designation_id ?? '')
                ->pluck('name_en')
                ->first();
            $department = Department::where('id', $infomrationEn->department_id ?? '')
                ->pluck('name_en')
                ->first();
            $infomrationEn->designation_id = $designation;
            $infomrationEn->department_id = $department;
        }

        if ($infomrationNp) {
            $designation = Designation::where('id', $infomrationNp->designation_id ?? '')
                ->pluck('name_np')
                ->first();
            $department = Department::where('id', $infomrationNp->department_id ?? '')
                ->pluck('name_np')
                ->first();
            $infomrationNp->designation_id = $designation;
            $infomrationNp->department_id = $department;
        }

        $principal->information_en = json_encode($infomrationEn ?? '');
        $principal->information_np = json_encode($infomrationNp ?? '');

        $featuredTeams = Teams::with(['department', 'designation'])
            ->whereIn('designation_id', [1, 2])
            ->where('is_published', true)
            ->orderBy('display_order')
            ->get();

        $otherTeams = Teams::with(['department', 'designation'])
            ->whereNotIn('designation_id', [1, 2])
            ->where('is_published', true)
            ->orderBy('display_order')
            ->get();

        return view('frontend.team', compact('founder', 'principal', 'featuredTeams', 'otherTeams'));
    }

    public function publication()
    {
        $publicationCategories = PublicationCategory::with([
            'publications' => function ($query) {
                $query->published()->orderBy('published_date', 'desc');
            },
        ])
            ->published()
            ->displayOrder()
            ->get();

        return view('frontend.publication.publication', compact('publicationCategories'));
    }

    public function publicationDetail($slug = null)
    {
        if ($slug) {
            $setting = Setting::first();
            $data = Publication::where('slug', $slug)->firstOrFail();
        }
        $allPublications = Publication::where('publication_category_id', $data->publication_category_id)->where('id', '!=', $data->id)->published()->latest()->take(6)->get();

        $aboutUs = AboutUs::select('description_en', 'description_np')->first();
        $route1 = 'publication';
        $route2 = 'publication-detail';

        return view('frontend.publication.publication-details', compact('setting', 'data', 'aboutUs', 'allPublications', 'route1', 'route2'));
    }

    public function siteMap()
    {
        $menus = Menu::orderBy('display_order')->get();
        return view('frontend.site-map', compact('menus'));
    }

    public function privacyStatement()
    {
        $menus = Menu::orderBy('display_order')->get();
        return view('frontend.privacy-statement', compact('menus'));
    }

    public function termsAndCondition()
    {
        $menus = Menu::orderBy('display_order')->get();

        return view('frontend.terms-and-condition', compact('menus'));
    }

    public function awards()
    {
        $awards = AwardRecognition::where('type', AwardAchivementTypeEnum::AWARD->value)->published()->displayOrder()->get();
        $setting = Setting::first();
        return view('frontend.awards', compact('awards', 'setting'));
    }

    public function achievements()
    {
        $achivements = AwardRecognition::where('type', AwardAchivementTypeEnum::ACHIVEMENT->value)->published()->displayOrder()->get();
        $setting = Setting::first();
        return view('frontend.achievements', compact('achivements', 'setting'));
    }

    public function testimonials()
    {
        $alumniTestimonials = Testimonial::with(['alumni' => function ($q) {
            $q->published()->displayOrder();
        }])->where('perspective_from', PerspectiveFromEnum::ALUMNI->value)->latest()->get();

        $guardianTestimonials = Testimonial::where('perspective_from', PerspectiveFromEnum::GUARDIAN->value)->latest()->get();

        $facultyTestimonials = Testimonial::where('perspective_from', PerspectiveFromEnum::FACULTY->value)->latest()->get();

        return view('frontend.testimonials', compact('alumniTestimonials', 'guardianTestimonials', 'facultyTestimonials'));
    }

    public function pageBuilder($slug)
    {
        $menu = Menu::with('page')->where('slug', $slug)->first();
        $socials = Setting::select('facebook', 'instagram', 'x', 'linkedin', 'youtube')->first();
        $aboutUs = AboutUs::select('description_en', 'description_np')->first();
        $publication = Publication::published()->featured()->orderByIdDesc()->take(10)->get();

        if ($menu) {
            return view('frontend.detailed-page', compact('menu', 'socials', 'aboutUs', 'publication'));
        } else {
            abort(404);
        }
    }

    public function storeSubscription(SubscriptionRequest $request)
    {
        DB::beginTransaction();
        try {
            Subscription::create([
                'email' => $request->email,
            ]);

            DB::commit();

            Session::flash('success', 'Email has been successfully registered to our News Letter');

            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
}

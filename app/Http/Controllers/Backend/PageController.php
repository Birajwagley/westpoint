<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Support\Str;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class PageController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.page.index');
    }

    public function pageData()
    {
        $datas = Page::with('menu')->get();

        return response()->json(['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::published()->get();

        return view('backend.page.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        DB::beginTransaction();
        try {
            $page = Page::create([
                'menu_id' => $request->menu_id,
                'title_en' => $request->title_en,
                'title_np' => $request->title_np,
                'short_description_en' => $request->short_description_en,
                'short_description_np' => $request->short_description_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
            ]);

            $bannerImagePath = '';
            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $bannerImagePath = 'uploads/page/banner_image/' . $page->id . '/' . $filename;

                $directory = public_path('uploads/page/banner_image/' . $page->id . '/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }

            $page->update([
                'banner_image' => $bannerImagePath,
            ]);

            DB::commit();

            Session::flash('success', 'Page created successfully.');

            return redirect()->route('page.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        $menus = Menu::published()->get();

        return view('backend.page.edit', compact('menus', 'page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page)
    {
        DB::beginTransaction();
        try {
            $page->update([
                'menu_id' => $request->menu_id,
                'title_en' => $request->title_en,
                'title_np' => $request->title_np,
                'short_description_en' => $request->short_description_en,
                'short_description_np' => $request->short_description_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
            ]);

            $bannerImagePath = null;
            if ($request->hasFile('banner_image')) {
                if ($page->banner_image && file_exists(public_path($page->banner_image))) {
                    unlink(public_path($page->banner_image));
                }

                $image = $request->file('banner_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $bannerImagePath = 'uploads/page/banner_image/' . $page->id . '/' . $filename;

                $directory = public_path('uploads/page/banner_image/' . $page->id . '/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);

                $page->update([
                    'banner_image' => $bannerImagePath,
                ]);
            }

            DB::commit();

            Session::flash('success', 'Page created successfully.');

            return redirect()->route('page.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/page/' . $page->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $page->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}

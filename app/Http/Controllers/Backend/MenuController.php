<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Menu;
use App\Enum\MenuTypeEnum;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class MenuController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with([
            'children' => function ($query) {
                $query->with('children');
            },
        ])
            ->displayOrder()
            ->where('parent_id', null)
            ->get();

        return view('backend.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $displayOrder = Menu::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        $menus = Menu::published()->get();
        $types = MenuTypeEnum::cases();

        return view('backend.menu.create', compact('menus', 'displayOrder', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        DB::beginTransaction();
        try {
            if (!$this->checkMenuLevel($request)) {
                Session::flash('warning', 'Only three level menu relation can be created.');

                return redirect()->back()->withInput();
            }

            $menu = Menu::create([
                'type' => $request->type,
                'slug' => $request->slug ? $this->checkUnique($request, null, 'menus') : null,
                'external_link' => $request->external_link,
                'parent_id' => $request->parent_id,
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'is_featured_navigation' => $request->is_featured_navigation,
                'icon' => $request->icon,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Menu created successfully.');

            return redirect()->route('menu.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $menus = Menu::published()->where('id', '!=', $menu->id)->get();
        $types = MenuTypeEnum::cases();

        return view('backend.menu.edit', [
            'menus' => $menus,
            'menuData' => $menu,
            'types' => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        DB::beginTransaction();
        try {
            if (!$this->checkMenuLevel($request)) {
                Session::flash('warning', 'Only three level menu relation can be created.');

                return redirect()->back()->withInput();
            }

            $menu->update([
                'type' => $request->type,
                'slug' => $request->type == MenuTypeEnum::SLUG->value ? $this->checkUnique($request, $menu->id, 'menus') : null,
                'external_link' => $request->type == MenuTypeEnum::EXTERNAL->value ? $request->external_link : null,
                'parent_id' => $request->parent_id,
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'is_featured_navigation' => $request->is_featured_navigation,
                'icon' => $request->icon,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Menu updated successfully.');

            return redirect()->route('menu.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/menu/' . $menu->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }
            $menu->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(false);
        }
    }

    private function checkMenuLevel($request)
    {
        // Check for 3-level limit
        if ($request->parent_id) {
            $parent = Menu::find($request->parent_id);
            if ($parent && $parent->parent_id) {
                $grandParent = Menu::find($parent->parent_id);
                if ($grandParent && $grandParent->parent_id) {
                    return false;
                }
            }
        }

        return true;
    }
}

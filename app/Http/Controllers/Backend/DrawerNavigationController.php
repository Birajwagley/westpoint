<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Menu;
use App\Models\DrawerNavigation;
use App\Enum\DrawerNavigationType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\DrawerNavigationRequest;
use App\Http\Controllers\Backend\BaseController;

class DrawerNavigationController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.drawer-navigation.index');
    }

    public function drawerNavigationData()
    {
        $datas = DrawerNavigation::with('menu')->displayOrder()->get();

        return response()->json(['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $displayOrder = DrawerNavigation::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        $types = DrawerNavigationType::cases();
        $menus = Menu::published()->displayOrder()->get();

        return view('backend.drawer-navigation.create', compact('types', 'displayOrder', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DrawerNavigationRequest $request)
    {
        DB::beginTransaction();
        try {
            $navigation = DrawerNavigation::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'icon' => $request->icon,
                'type' => $request->type,
                'menu_id' => $request->type == DrawerNavigationType::MENU->value ? $request->menu_id : null,
                'value' => ($request->type == DrawerNavigationType::EXTERNALLINK->value || $request->type == DrawerNavigationType::TEL->value) ? $request->value : null,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Drawer Navigation created successfully.');

            return redirect()->route('drawer-navigation.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DrawerNavigation $drawerNavigation)
    {
        $types = DrawerNavigationType::cases();
        $menus = Menu::published()->displayOrder()->get();

        return view('backend.drawer-navigation.edit', compact('types', 'menus', 'drawerNavigation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DrawerNavigationRequest $request, DrawerNavigation $drawerNavigation)
    {
        DB::beginTransaction();
        try {
            $drawerNavigation->update([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'icon' => $request->icon,
                'type' => $request->type,
                'menu_id' => $request->type == DrawerNavigationType::MENU->value ? $request->menu_id : null,
                'value' => ($request->type == DrawerNavigationType::EXTERNALLINK->value || $request->type == DrawerNavigationType::TEL->value) ? $request->value : null,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Drawer Navigation updated successfully.');

            return redirect()->route('drawer-navigation.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DrawerNavigation $drawerNavigation)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/drawerNavigation/' . $drawerNavigation->id);
            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $drawerNavigation->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}

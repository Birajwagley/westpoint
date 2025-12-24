<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Link;
use App\Models\Menu;
use App\Enum\LinkTypeEnum;
use App\Http\Requests\LinkRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Backend\BaseController;

class LinkController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.link.index');
    }

    public function linkData()
    {
        $datas = Link::with('menu')->displayOrderDesc()->get();

        return response()->json(['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $displayOrder = Link::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        $menus = Menu::published()->get();
        $types = LinkTypeEnum::cases();

        return view('backend.link.create', compact('menus', 'types', 'displayOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LinkRequest $request)
    {
        DB::beginTransaction();
        try {
            Link::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'type' => $request->type,
                'menu_id' => $request->menu_id,
                'url' => $request->url,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Link created successfully.');

            return redirect()->route('link.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        $menus = Menu::published()->get();
        $types = LinkTypeEnum::cases();

        return view('backend.link.edit', compact('menus', 'types', 'link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LinkRequest $request, Link $link)
    {
        DB::beginTransaction();
        try {
            $link->update([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'type' => $request->type,
                'menu_id' => $request->menu_id,
                'url' => $request->url,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Link updated successfully.');

            return redirect()->route('link.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        DB::beginTransaction();
        try {
            $link->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}

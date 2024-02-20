<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Http\Resources\Module\ModuleIndexResource;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ModuleIndexResource::collection(
            Module::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'data.name' => 'required',
            'data.translation' => 'required',
        ]);
        $module = Module::create($request->data);
//        $request->session()->flash('success', 'Категория добавлена');
        return  $module;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
       /* $request->validate([
            'title' => 'required',
        ]);*/
       // dd($request->all());
        $request->validate([
            'data.name' => 'required',
            'data.translation' => 'required',
        ]);
        $data = $request->data;
       // dd($data);
        $module = Module::find($id);
//        $category->slug = null;
        $module->update(["name" => $data['name'], "translation" => $data['translation']]);
       // return redirect()->route('categories.index')->with('success', 'Изменения сохранены');
        return $module;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
/*    public function destroy($id)
    {
        $module = Module::find($id);
        if ($module->units->count()) {
            return redirect()->route('categories.index')->with('error', 'Ошибка! У категории есть записи');
        }
        //$module->delete();
        return $module->delete();
    }*/


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroyAll(Request $request): int
    {

      $id = $request->moduleId;
        /*try {
            $ids = explode(",", $id);
            // call delete on the query builder (no get())
            $org->products()->whereIn('id', $ids)->delete();
        }
        catch {}
    }*/
        if (is_array($id))
        {
           return Module::destroy($id);
        }
        else
        {
            return Module::findOrFail($id)->delete();
        }
      /*  $category = Category::find($id);
        if ($category->posts->count()) {
            return redirect()->route('categories.index')->with('error', 'Ошибка! У категории есть записи');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Категория удалена');*/
    }
}

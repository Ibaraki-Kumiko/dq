<?php

namespace App\Http\Controllers;


use App\Http\Resources\Module\ModuleIndexResource;
use App\Http\Resources\Module\ModuleResource;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        return ModuleIndexResource::collection(
            Module::all());
    }

    public function show($slug)
    {
        $module = Module::where('slug', $slug)->firstOrFail();
        return new ModuleResource($module);
    }
}

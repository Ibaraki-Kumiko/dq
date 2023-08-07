<?php

namespace App\Http\Controllers;


use App\Http\Resources\ModuleResource;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        return ModuleResource::collection(
            Module::all());
    }

    public function show($id)
    {
        $module = Module::findOrFail($id);

        return new ModuleResource($module);
    }
}

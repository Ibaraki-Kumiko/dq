<?php

namespace App\Http\Controllers;


use App\Http\Resources\Module\ModuleIndexResource;
use App\Http\Resources\Module\ModuleResource;
use App\Models\Module;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        return ModuleIndexResource::collection(
            Module::all());
    }

    public function show($slug)
    {
        try {
            $module = Module::where('slug', $slug)->firstOrFail();
            return  new ModuleResource($module);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Запись не найдена'], 404);
        }

    }
}

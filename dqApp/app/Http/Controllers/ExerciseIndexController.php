<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExerciseIndexResource;
use App\Models\Exercise;
use App\Models\Module;
use App\Models\Unit;
use Illuminate\Http\Request;

class ExerciseIndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function __invoke(Request $request)
    {
      // $units = Unit::all();
       $modules = Module::all();
      //  $exercises =  Exercise::where('id', 1)->firstOrFail();


        return ExerciseIndexResource::collection($modules);
    }
}

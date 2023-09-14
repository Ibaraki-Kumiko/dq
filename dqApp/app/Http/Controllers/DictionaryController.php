<?php

namespace App\Http\Controllers;

use App\Http\Resources\DictionaryResource;
use App\Models\Dictionary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DictionaryController extends Controller
{
    public function show(Request $request)
    {
        $slug = $request->slug;
        $term = Dictionary::where('slug', $slug)->firstOrFail();
        return new DictionaryResource($term);
    }


    public function store(Request $request)
    {
        $file = $request->file('file');
        $jsonContents = file_get_contents($file);
        $data = json_decode($jsonContents, true);

        foreach ($data as $item) {
            Dictionary::create($item);
        }
    /*    try {
         //   $terms = $request->all();
            DB::table('dictionaries')->insert($data);
            return "Terms created successfully";
        }catch (Exception $e) {
            Log::error('Error creating term: ' . $e->getMessage());
            return "An error occurred while creating terms. Please check the logs for details.";
        }*/


    }
}

<?php

namespace App\Http\Resources;

use App\Http\Resources\Exercise\ExerciseResource;
use App\Http\Resources\Unit\UnitResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'translation' => $this->translation,
            /*'exercises' => ExerciseResource::collection($this->exercises),*/


              'units' => UnitResource::collection($this->units),
        ];
    }
}

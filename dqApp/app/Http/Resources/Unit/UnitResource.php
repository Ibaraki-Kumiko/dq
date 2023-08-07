<?php

namespace App\Http\Resources;

use App\Http\Resources\Exercise\ExerciseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'translation' => $this->translation,
            'exercises' => ExerciseResource::collection($this->exercises),
            'theory' => $this->theory()->exists()
        ];
    }
}

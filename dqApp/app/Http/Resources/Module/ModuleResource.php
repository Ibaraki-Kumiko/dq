<?php

namespace App\Http\Resources\Module;

use App\Http\Resources\Unit\UnitResource;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
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
            'translation'=> $this->translation,
            'description' => $this->description,
            'units' => UnitResource::collection($this->units),
        ];
    }
}

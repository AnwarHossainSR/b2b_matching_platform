<?php

namespace App\Http\Resources\Skills;

use App\Http\Resources\Common\PaginationResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SkillCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => SkillResource::collection($this->collection),
            'pagination' => new PaginationResource($this)
        ];
    }
}

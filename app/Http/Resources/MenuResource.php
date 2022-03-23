<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = [];
        #filter in array of data
        foreach ($this->resource as $item) {
            $result[] = [
                "recipe_id" => $item->id,
                "recipe_title" => $item->title,
                "best_before" => minColumnInCollection($item->ingredients, "best_before")
            ];
        }
        #end
        return $result;
    }
}

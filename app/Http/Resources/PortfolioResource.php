<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'service' => ServiceResource::make($this->service),
            'images' => $this->images->count()?ImageResource::collection($this->images):[
                [
                    'id'=> 0,
                    'url' => asset('be_assets/images/log.jpeg')
                ]
            ],
        ];
    }
}

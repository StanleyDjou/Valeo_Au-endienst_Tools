<?php

namespace App\Http\Resources;

use App\Models\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
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
            'status' => $this->status,
            'user'=>UserResource::make($this->user),
            'skills' => json_decode($this->skills),
            'service' => ServiceResource::collection(isset($this->service_id)? UserService::find($this->service_id): []),
            'images' => $this->images->count()?ImageResource::collection($this->images):[[
                'id'=> 0,
                'url' => asset('be_assets/images/log.jpeg')
            ]],
            'date' => $this->date->format('l d, M Y'),
            'time' => $this->date->format('h:i'),
        ];
    }
}

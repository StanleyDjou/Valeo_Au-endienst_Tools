<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = [
            'id' => $this->id,
            'email' => $this->email ?? "",
            'first_name' => $this->first_name,
            'last_name' =>$this->last_name,
            'profile' => $this->profile?asset('storage/' . $this->profile):asset('be_assets/images/users/avatar-1.jpg'),
            'phone' => $this->phone,
            'role' => $this->role ?? "",
            'company' => $this->company ?? "",
            'address' => $this->address ?? "",
            'city' => $this->city ? $this->city->name : '',
            'region' => $this->region ? $this->region->name : '',
            'city_id' => $this->city_id ,
            'region_id' => $this->region_id ,
            'website' => $this->website ?? '',
            'bio' => $this->bio ?? ''
        ];

        return $result;
    }
}

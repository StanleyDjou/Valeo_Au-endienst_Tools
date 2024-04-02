<?php

namespace App\Http\Resources;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $skills = Skill::whereHas('services', function ($q){
            $q->where('user_id', $this->id);
        })->get()->pluck('name')->toArray();

        $result = [
            'id' => $this->id,
            'email' => $this->email ?? "",
            'name' => $this->first_name." ".$this->last_name,
            'profile' => $this->profile ? asset('storage/' . $this->profile) : asset('be_assets/images/users/avatar-1.jpg'),
            'phone' => $this->phone,
            'skills' => implode(", ", $skills),
            'role' => $this->role ?? "",
            'status' => "Available",
            'company' => $this->company ?? "",
            'address' => $this->address ?? "",
            'city' => $this->city ? $this->city->name : '',
            'region' => $this->region ? $this->region->name : '',
            'website' => $this->website ?? '',
            'bio' => $this->bio ?? '',
            'services' => ServiceResource::collection($this->services),
            'portfolio' => PortfolioResource::collection($this->portfolio)
        ];

        return $result;
    }
}

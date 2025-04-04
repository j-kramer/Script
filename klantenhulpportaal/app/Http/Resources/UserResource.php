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
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'is_admin' => $this->is_admin,
            $this->mergeWhen($request->user()->is_admin, [
                'email' => $this->email,
                'phone_number' => $this->phone_number,
            ]),
            'fullName' => $this->first_name.' '.$this->last_name,
        ];
    }
}

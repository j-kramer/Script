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
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'isAdmin' => $this->is_admin,
            $this->mergeWhen($request->user()->is_admin, [
                'email' => $this->email,
                'phonenumber' => $this->phone_number,
            ]),
            'fullName' => $this->first_name.' '.$this->last_name,
        ];
    }
}

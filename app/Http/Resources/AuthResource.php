<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            'user' => [
                'id' => $this->resource['user']->id,
                'email' => $this->resource['user']->email
            ],
            'token' => $this->resource['token']
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
            'code' => 200
        ];
    }
}

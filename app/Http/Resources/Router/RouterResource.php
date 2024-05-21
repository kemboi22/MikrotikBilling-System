<?php

namespace App\Http\Resources\Router;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "ipAddress" => $this->ip_address,
            "username" => $this->username,
            "password" => $this->password,
            "connect" => $this->connect,
            "port" => $this->port,
            "protocol" => $this->protocol,
            "secret" => $this->secret,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at
        ];
    }
}

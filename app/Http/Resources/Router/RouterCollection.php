<?php

namespace App\Http\Resources\Router;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RouterCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($router) {
            return new RouterResource($router);
        })->toArray();
    }
}

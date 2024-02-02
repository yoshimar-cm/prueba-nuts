<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'products',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'name' => $this->resource->name,
                'slug' => $this->resource->slug,
                'description' => $this->resource->description,
                'video' => asset("storage/{$this->resource->video}"),
                'images' => ProductImageResource::collection($this->resource->images)
            ],
            'links' => [
                'self' => route('api.v1.products.show', $this->resource)
            ]
        ];
    }



    public function toResponse($request)
    {
        return parent::toResponse($request)->withHeaders([
            'Location' => route('api.v1.products.show', $this->resource)
        ]);
    }
}

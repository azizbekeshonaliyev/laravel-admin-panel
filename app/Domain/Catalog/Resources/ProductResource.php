<?php

namespace App\Domain\Catalog\Resources;

use App\Domain\Album\Resources\AlbumResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'desc' => $this->desc,
            'category' => new CategoryResource($this->category),
            'album' => new AlbumResource($this->album),
            'price' => $this->price,
            'in_stock' => $this->in_stock,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
        ];
    }
}

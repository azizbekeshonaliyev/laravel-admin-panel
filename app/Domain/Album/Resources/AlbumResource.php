<?php

namespace App\Domain\Album\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'cover_image' => new ImageResource($this->image),
            'images' => new ImageCollection($this->images),
        ];
    }
}

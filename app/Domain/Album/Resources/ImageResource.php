<?php

namespace App\Domain\Album\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'src' => config('app.url').$this->path,
        ];
    }
}

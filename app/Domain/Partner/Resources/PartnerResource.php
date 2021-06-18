<?php

namespace App\Domain\Partner\Resources;

use App\Domain\Album\Resources\AlbumResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'desc' => $this->desc,
            'album' => new AlbumResource($this->album),
        ];
    }
}

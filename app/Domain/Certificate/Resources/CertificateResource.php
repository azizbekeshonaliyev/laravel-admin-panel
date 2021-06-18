<?php

namespace App\Domain\Certificate\Resources;

use App\Domain\Album\Resources\AlbumResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
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

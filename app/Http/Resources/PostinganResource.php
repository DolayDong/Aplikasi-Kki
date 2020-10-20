<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostinganResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "postingan_id" => $this->id,
            "user_id" => $this->user_id,
            "caption" => $this->caption,
            "url_postingan" => $this->url_image,
            "waktu_diunggah" => $this->diunggah,
            // "user" => [
            //     "nama" => $this->user->name,
            //     "photo_profile" => $this->user->url_image
            // ]
        ];
    }
}

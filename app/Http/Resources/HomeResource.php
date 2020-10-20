<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use PHPUnit\Framework\Constraint\Count;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            "user_id" => $this->user_id,
            "teman_id" => $this->teman_id,
            "postingans" => PostinganResource::collection($this->postingans),
            "teman" => [
                "photo_profile" => $this->teman->url_image,
                "nama_teman" => $this->teman->name,
                
            ],
            "aktif" => $this->session
        ];
    }
}

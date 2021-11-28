<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use GuzzleHttp\Client;

class BankResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $client = new Client();
        $res = $client->get($this->api . '/api/info');
        $data = json_decode($res->getBody(), true);

        return [
            'id' => $this->id,
            'slug' => $data['slug'],
            'name' => $data['name'],
            'image' => $data['image'],
            'description' => $data['desc'],
            'login_route' => $this->api . "/api/client/",
            'created_at' => $this->created_at,
        ];
    }
}

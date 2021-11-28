<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'api',
    ];

    public function getBankName()
    {
        $client = new Client();
        $res = $client->get($this->api . '/api/info');
        $data = json_decode($res->getBody(), true);
        return $data['name'];
    }
    public function getBankImage()
    {
        $client = new Client();
        $res = $client->get($this->api . '/api/info');
        $data = json_decode($res->getBody(), true);
        return $data['image'];
    }
    public function getBankDesc()
    {
        $client = new Client();
        $res = $client->get($this->api . '/api/info');
        $data = json_decode($res->getBody(), true);
        return $data['desc'];
    }
}

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

    public function bankName()
    {
        $client = new Client();
        $res = $client->get($this->api . '/api/info');
        $data = json_decode($res->getBody(), true);
        return $data['name'];
    }
    public function bankImage()
    {
        $client = new Client();
        $res = $client->get($this->api . '/api/info');
        $data = json_decode($res->getBody(), true);
        return $data['image'];
    }
}

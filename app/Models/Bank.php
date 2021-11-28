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
        $data = $this->get_content($this->api . '/api/info');
        $data = json_decode($data, true);
        if ($data) {
            return $data['name'];
        }
        return "N/A";
    }
    public function bankImage()
    {
        $data = $this->get_content($this->api . '/api/info');
        $data = json_decode($data, true);
        if ($data) {
            return $data['image'];
        }
        return "N/A";
    }

    public function get_content($url)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_ENCODING       => "",
            CURLOPT_USERAGENT      => "test",
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 120,
            CURLOPT_TIMEOUT        => 120,
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);

        $content  = curl_exec($ch);

        curl_close($ch);

        return $content;
    }
}

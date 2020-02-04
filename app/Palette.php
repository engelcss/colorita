<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Palette extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->url = $this->generateUrl();
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    public function colors()
    {
        return $this->hasMany('\App\Color');
    }

    public function generateUrl()
    {
        $url = Str::random(5);
        if (self::where('url', $url)->count() != 0) {
            return $this->generateUrl();
        } else {
            return $url;
        }
    }
}

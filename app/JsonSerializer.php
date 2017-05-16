<?php
namespace App;

use League\Fractal\Resource\NullResource;
use Spatie\Fractalistic\ArraySerializer;

class JsonSerializer extends ArraySerializer
{
    public function null()
    {
        return new NullResource;
    }
}
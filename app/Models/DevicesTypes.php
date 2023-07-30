<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevicesTypes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $appends = ['image_url'];

    protected $fillable = ['name', 'price', 'image'];

    /**
     * Return image url for this model.
     */
    public function getImageUrlAttribute()
    {
        return ($this->image == "") ? url('images', 'device_type.svg') : url('images', $this->image);
    }
}

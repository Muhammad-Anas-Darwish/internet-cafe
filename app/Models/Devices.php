<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devices extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $with = ['device_type'];
    // protected $appends = ['customer'];

    public function device_type(): BelongsTo
    {
        return $this->belongsTo(DevicesTypes::class);
    }

    public function customer(): Customers | Null
    {
        return Customers::where('device_id', $this->number)->first();
    }
}

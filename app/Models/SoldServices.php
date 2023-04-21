<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SoldServices extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $with = ['service', 'customer'];
    protected $fillable = ['customer_id', 'service_id', 'number'];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }
}

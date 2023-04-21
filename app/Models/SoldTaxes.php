<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SoldTaxes extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $with = ['taxe', 'customer'];
    protected $fillable = ['customer_id', 'taxe_id'];

    public function taxe(): BelongsTo
    {
        return $this->belongsTo(Taxes::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }
}

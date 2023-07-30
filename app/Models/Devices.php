<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Devices extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $with = ['device_type'];
    protected $appends = ['status'];

    public function device_type(): BelongsTo
    {
        return $this->belongsTo(DevicesTypes::class);
    }
    
    public function customer(): Customers | Null
    {
        return Customers::where('device_id', $this->number)->first();
    }

    /**
     * get device status and color
     */
    public function getStatusAttribute(): array
    {
        $customer = $this->customer();

        if (is_null($customer)) // The device is empty
            return ['status' => 'time', 'bg-trans' => 'bg-trans-black', 'bg' => 'bg-black'];

        if ($customer->is_open_time) // The Device is open time
            return ['status' => 'open-time', 'bg-trans' => 'bg-trans-blue', 'bg' => 'bg-blue'];


        if ($this->customer()->remaining_time !== false) {
            $remaining_time = Carbon::parse($this->customer()->remaining_time);
            if ($remaining_time->greaterThan(new Carbon('00:10:00')))
                return ['status' => 'specific-time', 'bg-trans' => 'bg-trans-green', 'bg' => 'bg-green'];
            return ['status' => 'specific-time', 'bg-trans' => 'bg-trans-green', 'bg' => 'bg-orange'];
        }

        return ['status' => 'end-time', 'bg-trans' => 'bg-trans-red', 'bg' => 'bg-red'];

    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customers extends Model
{
    use HasFactory;
    // public $timestamps = false;
    const CREATED_AT = 'from_time';
    const UPDATED_AT = Null;

    protected $with = ['device'];
    protected $appends = ['remaining_time', 'services_cost', 'taxes_cost', 'reserved_time_cost', 'total_time', 'total_cost', 'sold_services', 'sold_taxes'];
    protected $fillable = ['device_id', 'from_time', 'reserved_time', 'is_open_time'];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Devices::class, 'device_id', 'number');
    }

    /**
     * create remaining time field
     */
    public function getRemainingTimeAttribute(): string | bool
    {
        $reserved_time = Carbon::parse($this->reserved_time);
        $end_time = Carbon::parse($this->from_time)
            ->addHours($reserved_time->hour)
            ->addMinutes($reserved_time->minute)
            ->addSeconds($reserved_time->second);

        if (Carbon::now()->greaterThan($end_time)) {
            return false;
        }

        return Carbon::now()->diff($end_time)->format('%H:%I:%S');
    }

    /**
     * create total time field
     */
    public function getTotalTimeAttribute()
    {
        if ($this->is_open_time)
            return Carbon::now()->diff($this->from_time)->format('%H:%I:%S');
        return $this->reserved_time;
    }

    /**
     * Get all services associated with the customer
     */
    public function getServicesCostAttribute(): int
    {
        $total_cost = 0;
        $services = SoldServices::all()->where('customer_id', $this->id);

        foreach ($services as $service) {
            $total_cost += $service->number * $service->service->price;
        }

        return sprintf($total_cost);
    }

    /**
     * Get all taxes associated with the customer
     */
    public function getTaxesCostAttribute(): int
    {
        $total_cost = 0;

        $taxes = SoldTaxes::all()->where('customer_id', $this->id);

        foreach ($taxes as $taxe) {
            $total_cost += $taxe->taxe->price;
        }

        return sprintf($total_cost);
    }

    /**
     * Get the total cost of using the device
     */
    public function getReservedTimeCostAttribute()
    {
        $total_cost = 0;


        if ($this->is_open_time) {
            // convert reserved time to seconds
            $total_time_seconds = Carbon::parse($this->total_time);
            $total_time_seconds = $total_time_seconds->diffInSeconds(Carbon::today());

            $total_cost = $total_time_seconds * ($this->device->device_type->price / 3600);
        }
        else {
            // convert reserved time to seconds
            $reserved_time_seconds = Carbon::parse($this->reserved_time);
            $reserved_time_seconds = $reserved_time_seconds->diffInSeconds(Carbon::today());

            $total_cost = $reserved_time_seconds * ($this->device->device_type->price / 3600);
        }
        return sprintf("%0.2f", $total_cost);
    }

    /**
     * Get the customer's total cost
     */
    public function getTotalCostAttribute()
    {
        return sprintf("%0.2f", $this->getReservedTimeCostAttribute() + $this->getServicesCostAttribute() + $this->getTaxesCostAttribute());
    }

    /**
     * Get sold services associated with the customer
     */
    public function getSoldServicesAttribute()
    {
        return SoldServices::all()->where('customer_id', $this->id);
    }

    /**
     * Get sold taxes associated with the customer
     */
    public function getSoldTaxesAttribute()
    {
        return SoldTaxes::all()->where('customer_id', $this->id);
    }

    /**
     * get all customers sorted by remaining time
     */
    public function getAllCustomersSortedByRemainingTime(): Collection
    {
        $customers = Customers::all();
        $sorted_customers = $customers->sortBy(function ($customer) {
            return $customer->remaining_time;
        });
        return $sorted_customers;
    }
}

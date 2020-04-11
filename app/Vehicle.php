<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeTodaysVehicles($query)
    {
        $tomorrow  = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
        $yesterday  = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m")  , date("d"), date("Y")));

        $todaysOrders = $query->whereBetween('created_at', [$yesterday, $tomorrow])->get();

        return $todaysOrders;
    }

    public function scopeReshoots($query, $vehicleId, $vehicleWorkOrder)
    {
        // Returns a list of vehicles with the same work_order except for the one with called with sorted by most recent
        $listVehicles = $query->where('work_order', $vehicleWorkOrder)
            ->get()
            ->sortDesc();

        return $listVehicles;
    }
}
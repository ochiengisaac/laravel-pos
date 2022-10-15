<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'merchant_id',
        'supplier_id',
        'subject',
        'description',
        'expected_delivery_date',
        'user_id'
    ];

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMerchantName()
    {
        if($this->merchant) {
            return $this->merchant->first_name . ' ' . $this->merchant->last_name;
        }
        return null;
    }

    public function getSupplierName()
    {
        if($this->supplier) {
            return $this->supplier->first_name . ' ' . $this->supplier->last_name;
        }
        return null;
    }

    public function getUserName()
    {
        if($this->user) {
            return $this->user->first_name . ' ' . $this->user->last_name;
        }
        return null;
    }

    public function total()
    {
        return $this->items->map(function ($i){
            return $i->price;
        })->sum();
    }

    public function formattedTotal()
    {
        return number_format($this->total(), 2);
    }

    public function receivedAmount()
    {
        return $this->payments->map(function ($i){
            return $i->amount;
        })->sum();
    }

    public function formattedReceivedAmount()
    {
        return number_format($this->receivedAmount(), 2);
    }

    public function updateStatus($status, $reason)
    {
        
        $newStatus = PurchaseOrderStatusType::where('alias', $status)->first();
        PurchaseOrderStatusTypeChange::create([
            'user_id' => auth()->user()->id,
            'purchase_order_id' => $this->id,
            //'status' => $status,
            'purchase_order_status_type_id' => $newStatus->id,
            'description' => $reason
        ]);
        $this->purchase_order_status_type_id = $newStatus->id;
        $this->save();
    }

}

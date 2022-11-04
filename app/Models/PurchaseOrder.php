<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Contact;
use App\Models\PurchaseOrderItem;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'supplier_id',
        'user_id',
        'expected_delivery_date',
        'subject',
        'description',
        'deleted'
    ];

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function customer()
    {
        $customer = null;
        if($this->customer_id != null){
            $customer = Contact::where("deleted", "=", 0)->where("id", "=", $this->customer_id)->first();

        }
        return $customer;
    }

    public function supplier()
    {
        $supplier = null;
        if($this->supplier_id != null){
            $supplier = Contact::where("deleted", "=", 0)->where("id", "=", $this->supplier_id)->first();

        }
        return $supplier;
    }

    public function user()
    {
        $user = null;
        if($this->user_id != null){
            $user = User::where("id", "=", $this->user_id)->first();

        }
        return $user;
    }

    public function getCustomerName()
    {
        $cust = $this->customer();
        if($cust) {
            return $this->cust->first_name . ' ' . $this->cust->last_name;
        }
        return 'Guest Customer';
    }

    public function getSupplierName()
    {
        $sup = $this->supplier();
        if($sup) {
            return $this->sup->first_name . ' ' . $this->sup->last_name;
        }
        return 'Guest Supplier';
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

    public function sumOfPaymentsAmount()
    {
        return $this->payments->map(function ($i){
            return $i->amount;
        })->sum();
    }

    public function formattedSumOfPaymentsAmount()
    {
        return number_format($this->sumOfPaymentsAmount(), 2);
    }
}

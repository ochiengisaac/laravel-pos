<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Contact;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id',
        'deleted'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
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

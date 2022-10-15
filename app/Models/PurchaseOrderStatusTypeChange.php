<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderStatusTypeChange extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'purchase_order_id',  'purchase_order_status_type_id', 'description'
    ];

    /**
     * Link to the purchaseOrderStatusType.
     */
    public function purchaseOrderStatusType()
    {
        return $this->belongsTo(PurchaseOrderStatusType::class);
    }

    /**
     * Link to the purchaseOrder.
     */
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    /**
     * Link to the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
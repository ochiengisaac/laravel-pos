<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderStatusType extends Model
{
    protected $fillable = [
        'title',
        'description',
        'alias',
        'barcode',
        'deleted',
        'user_id'
    ];
}

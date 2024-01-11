<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShopBranch;


class BranchBill extends Model
{
    use HasFactory;


    protected $fillable = [
        'shop_id',
        'brach_id',
        'bill_date',
        'bill_amount',
    ];

    public function shop_branch(){
        return $this->belongsTo(ShopBranch::class, 'branch_id', 'id');
    }

    public function shop(){
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }
    
}

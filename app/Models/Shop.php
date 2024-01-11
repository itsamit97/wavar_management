<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ShopBranch;

class Shop extends Model
{
    use HasFactory;


    protected $fillable = [
        'shop_name',
        'sort_order',
        'branch_identifier',
        'contact_period',
        'phone_no',
        'email',
        'user_id',
        'status',
        'is_disable'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop_branch(){
        return $this->hasMany(ShopBranch::class);
    }

    public function shop_branch_bill(){
        return $this->hasMany(BranchBill::class);
    }


    public function shopBranchList(){
        return $this->hasMany(ShopBranch::class);
    }


}

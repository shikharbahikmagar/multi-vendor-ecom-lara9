<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';
    //raltion with vendor details
    public function VendorPersonal()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }
    //relation with venodr business details
    public function VendorBusiness()
    {
        return $this->belongsTo('App\Models\VendorsBusinessDetail', 'vendor_id');
    }
    //relation with vendor bank details
    public function VendorBank()
    {
        return $this->belongsTo('App\Models\VendorsBankDetail', 'vendor_id');
    }
}

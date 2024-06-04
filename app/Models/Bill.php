<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table ='bills';
    // //Truyền 3 tham số ('đường dẫn đến models','fk','pk')
    // public function bill_detail(){
    //     return $this->hasMany('App\BillDetail','id_bill','id');
    // }
    // public function bill(){
    //     return $this->belongsTo('App\Customer','id_customer','id');
    // }
}

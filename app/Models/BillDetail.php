<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;
    protected $table ='bill_detail';
    // public function product(){
    //     return $this->belongsTo('App\Product','product_id','id');
    // }
    // //Truyền 3 tham số ('đường dẫn đến models','fk','pk  ')
    // public function bill(){
    //     return $this->belongsTo('App\Bill','id_bill','id');
    // }
}

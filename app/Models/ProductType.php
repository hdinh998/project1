<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table ='type_products';
    
    //Truyền 3 tham số ('đường dẫn đến models','fk','pk')
    public function product(){
        return $this->hasMany('App\Product','id_type','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product_catagory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class products extends Model
{
    use HasFactory;
    public $table = 'products';

    // public function category()
    // {
    //     return $this->belongTo(product_catagory::class, 'product_catagoryId', 'product_catagoryId');
    // }

//  $fill =$this.catagory();
}

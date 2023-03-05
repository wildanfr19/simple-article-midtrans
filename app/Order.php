<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function checkOrderExists($name, $artikel_id, $status)
    {
        $cek = \DB::table('orders')
               ->where('name','=', $name)
               ->where('artikel_id','=', $artikel_id)
               ->where('status','=', 'Paid')
               ->get();
        // if ($cek->isNotEmpty()) {
            
        // }

        return $cek;
              

    }
}

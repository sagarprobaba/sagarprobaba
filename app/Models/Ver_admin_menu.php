<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ver_admin_menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function submenu()
    {
        return $this->hasMany(Ver_admin_menu::class,'parent')->orderBy('menu_order','ASC')->where('status',1);
    }
}

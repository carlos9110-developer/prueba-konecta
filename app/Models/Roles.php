<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = ['rol','created_at', 'updated_at'];

    protected $guarded = ['id'];

    public function listarSelect()
    {
        return Roles::select('id','rol')->get();
    }

}

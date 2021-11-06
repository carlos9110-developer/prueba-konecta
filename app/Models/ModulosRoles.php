<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulosRoles extends Model
{
    use HasFactory;

    protected $fillable = ['id_rol', 'id_modulo', 'created_at', 'updated_at'];

    protected $guarded = ['id'];

}

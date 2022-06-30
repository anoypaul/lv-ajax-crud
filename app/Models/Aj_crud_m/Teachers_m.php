<?php

namespace App\Models\Aj_crud_m;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers_m extends Model
{
    use HasFactory;

    protected $table = 'teachers';
    protected $primaryKey = 'teachers_id';
    protected $fillable = ['teachers_name', 'teachers_title', 'teachers_institute'];
}

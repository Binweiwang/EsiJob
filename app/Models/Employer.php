<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected $table = 'employers';
    protected $fillable = [
        'email',
        'password',
        'name',
        'last_name',
        'name_company',
        'phone',
        'id_person',
        'description',
        'address',
        'city',
        'state'
    ];
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}

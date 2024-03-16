<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $fillable = [
        'employer_id',
        'title',
        'requirements',
        'description',
        'salary',
        'publication_date',
        'state'
    ];

    public function scopeSearch($query, $serach)
    {
        return $query->whereRaw('LOWER(title) like ?', ['%' . strtolower($serach) . '%']);
    }
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}

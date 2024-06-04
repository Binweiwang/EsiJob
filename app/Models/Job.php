<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'user_id',
        'title',
        'requirements',
        'description',
        'salary',
        'publication_date',
        'state',
        'location',
        'workday',
        'company_logo',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->whereRaw('LOWER(title) like ?', ['%' . strtolower($search) . '%']);
    }

    public function scopeLocation($query, $location)
    {
        return $query->whereRaw('LOWER(location) like ?', ['%' . strtolower($location) . '%']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

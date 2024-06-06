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

    /**
     * @param $query query para buscar en la base de datos
     * @param $search string a buscar
     * @return mixed retorna la consulta con el filtro de busqueda
     */
    public function scopeSearch($query, $search)
    {
        return $query->whereRaw('LOWER(title) like ?', ['%' . strtolower($search) . '%']);
    }

    /**
     * @param $query query para buscar en la base de datos
     * @param $location string a buscar
     * @return mixed retorna la consulta con el filtro de busqueda
     */
    public function scopeLocation($query, $location)
    {
        return $query->whereRaw('LOWER(location) like ?', ['%' . strtolower($location) . '%']);
    }

    /**
     * @return relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

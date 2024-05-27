<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::query();

        // Aplicar el filtro de búsqueda si está presente
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        if ($request->filled('workday')) {
            $workdays = $request->workday;
            $query->whereIn('workday', $workdays);
        }

        // Aplicar el filtro de ubicación si está presente
        if ($request->filled('location')) {
            $query->location($request->location);
        }

        // Obtener los trabajos paginados
        $jobs = $query->paginate(15);

        // Obtener los empleadores únicos de los trabajos filtrados
        $employers = $jobs->pluck('employer_id')->unique();

        $provinces = [
            'Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Zaragoza', 'Málaga', 'Murcia', 'Palma', 'Las Palmas',
            'Bilbao', 'Alicante', 'Córdoba', 'Valladolid', 'Vigo', 'Gijón', 'Hospitalet', 'Vitoria', 'A Coruña',
            'Granada', 'Elche', 'Oviedo', 'Badalona', 'Cartagena', 'Terrassa', 'Jerez', 'Sabadell', 'Móstoles',
            'Santa Cruz de Tenerife', 'Pamplona', 'Almería', 'San Sebastián', 'Burgos', 'Santander', 'Castellón',
            'Alcorcón', 'Albacete', 'Getafe', 'Salamanca', 'Logroño', 'San Cristóbal de La Laguna', 'Huelva',
            'Marbella', 'Badajoz', 'Lleida', 'Tarragona', 'León', 'Cádiz', 'Jaén'
        ];
        sort($provinces);

        return view('home', compact('jobs', 'employers', 'provinces'));
    }

    public function show(Job $job)
    {
        // 返回一个特定的工作
    }

    public function create()
    {
        // 显示创建工作的表单
    }

    public function store(Request $request)
    {
        // 验证并存储新的工作
    }

    public function edit(Job $job)
    {
        // 显示编辑工作的表单
    }

    public function update(Request $request, Job $job)
    {
        // 验证并更新工作
    }

    public function destroy(Job $job)
    {
        // 删除工作
    }
}

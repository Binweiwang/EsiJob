<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\SearchHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $isLoggedIn = Auth::check();
        $credits = $isLoggedIn ? Auth::user()->credits : 0;
        // Obtener los empleadores únicos de los trabajos filtrados
        $employers = $jobs->pluck('user_id')->unique();

        $provinces = [
            'Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Zaragoza', 'Málaga', 'Murcia', 'Palma', 'Las Palmas',
            'Bilbao', 'Alicante', 'Córdoba', 'Valladolid', 'Vigo', 'Gijón', 'Hospitalet', 'Vitoria', 'A Coruña',
            'Granada', 'Elche', 'Oviedo', 'Badalona', 'Cartagena', 'Terrassa', 'Jerez', 'Sabadell', 'Móstoles',
            'Santa Cruz de Tenerife', 'Pamplona', 'Almería', 'San Sebastián', 'Burgos', 'Santander', 'Castellón',
            'Alcorcón', 'Albacete', 'Getafe', 'Salamanca', 'Logroño', 'San Cristóbal de La Laguna', 'Huelva',
            'Marbella', 'Badajoz', 'Lleida', 'Tarragona', 'León', 'Cádiz', 'Jaén'
        ];
        sort($provinces);

        return view('home', compact('jobs', 'employers', 'provinces', 'isLoggedIn', 'credits'));
    }

    public function reduceCredits(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->credits > 0) {
            $user->credits -= 1;
            $user->save();
            return response()->json(['success' => true, 'credits' => $user->credits]);
        }
        return response()->json(['success' => false, 'message' => 'No tienes suficientes créditos.']);
    }
    public function show(Job $job)
    {
        // 返回一个特定的工作
    }

    public function create()
    {
        $provinces = [
            'Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Zaragoza', 'Málaga', 'Murcia', 'Palma', 'Las Palmas',
            'Bilbao', 'Alicante', 'Córdoba', 'Valladolid', 'Vigo', 'Gijón', 'Hospitalet', 'Vitoria', 'A Coruña',
            'Granada', 'Elche', 'Oviedo', 'Badalona', 'Cartagena', 'Terrassa', 'Jerez', 'Sabadell', 'Móstoles',
            'Santa Cruz de Tenerife', 'Pamplona', 'Almería', 'San Sebastián', 'Burgos', 'Santander', 'Castellón',
            'Alcorcón', 'Albacete', 'Getafe', 'Salamanca', 'Logroño', 'San Cristóbal de La Laguna', 'Huelva',
            'Marbella', 'Badajoz', 'Lleida', 'Tarragona', 'León', 'Cádiz', 'Jaén'
        ];
        sort($provinces);
        return view('jobs.form',compact('provinces'));
        // 显示创建工作的表单
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary' => 'required|string|max:255',
            'location' => 'required|string',
            'workday' => 'required|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Manejar la subida del logotipo de la empresa
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('logos', 'public');
        } else {
            $logoPath = null;
        }

        // Crear una nueva oferta de trabajo
        Job::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'requirements' => $request->input('requirements'),
            'salary' => $request->input('salary'),
            'location' => $request->input('location'),
            'workday' => $request->input('workday'),
            'company_logo' => $logoPath,
            'publication_date' => now(),
            'state' => 'active', // o cualquier valor predeterminado que necesites
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('home')->with('status', 'job-posted');
    }
    public function userJobs()
    {
        $jobs = Auth::user()->jobs()->paginate(9); // Assuming a User has many Jobs relationship
        return view('jobs.user-jobs', compact('jobs'));
    }
    public function edit(Job $job)
    {
        // 显示编辑工作的表单
        $provinces = [
            'Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Zaragoza', 'Málaga', 'Murcia', 'Palma', 'Las Palmas',
            'Bilbao', 'Alicante', 'Córdoba', 'Valladolid', 'Vigo', 'Gijón', 'Hospitalet', 'Vitoria', 'A Coruña',
            'Granada', 'Elche', 'Oviedo', 'Badalona', 'Cartagena', 'Terrassa', 'Jerez', 'Sabadell', 'Móstoles',
            'Santa Cruz de Tenerife', 'Pamplona', 'Almería', 'San Sebastián', 'Burgos', 'Santander', 'Castellón',
            'Alcorcón', 'Albacete', 'Getafe', 'Salamanca', 'Logroño', 'San Cristóbal de La Laguna', 'Huelva',
            'Marbella', 'Badajoz', 'Lleida', 'Tarragona', 'León', 'Cádiz', 'Jaén'
        ];
        sort($provinces);
        return view('jobs.form', compact('job', 'provinces'));
    }

    public function update(Request $request, Job $job)
    {
        // Validar los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary' => 'required|string|max:255',
            'location' => 'required|string',
            'workday' => 'required|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Manejar la subida del logotipo de la empresa
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('logos', 'public');
        } else {
            $logoPath = $job->company_logo;
        }

        // Actualizar la oferta de trabajo
        $job->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'requirements' => $request->input('requirements'),
            'salary' => $request->input('salary'),
            'location' => $request->input('location'),
            'workday' => $request->input('workday'),
            'company_logo' => $logoPath,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('home');
    }

    public function destroy(Job $job)
    {
        // 删除工作
    }
}

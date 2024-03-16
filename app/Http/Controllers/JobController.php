<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::search($request->search)->paginate(10);
        return view('home', compact('jobs'));
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

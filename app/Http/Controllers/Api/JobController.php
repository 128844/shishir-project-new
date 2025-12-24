<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            $jobs = Job::with('employer')->get();
        } elseif ($user->hasRole('employer')) {
            $jobs = Job::with('employer')->where('employer_id', $user->id)->get();
        } else {
            $jobs = Job::with('employer')->where('status', 'open')->get();
        }

        return response()->json($jobs);
    }

    // Store job (employer only)
    public function store(JobRequest $request)
    {
        $user = Auth::user();

        if (!$user->hasAnyRole(['employer', 'super_admin'])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $data = $request->validated();
        $data['employer_id'] = $user->id;

        $job = Job::create($data);

        return response()->json([
            'message' => 'Job created successfully',
            'job' => $job
        ]);
    }
    public function show(Job $job)
    {
        $user = Auth::user();

        if ($user->hasRole('employer') && $job->employer_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($job);
    }
    public function update(JobRequest $request, Job $job)
    {
        $user = Auth::user();

        if ($user->hasRole('employer') && $job->employer_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $job->update($request->validated());

        return response()->json([
            'message' => 'Job updated successfully',
            'job' => $job
        ]);
    }
    public function destroy(Job $job)
    {
        $user = Auth::user();

        if ($user->hasRole('employer') && $job->employer_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $job->delete();

        return response()->json(['message' => 'Job deleted successfully']);
    }
}

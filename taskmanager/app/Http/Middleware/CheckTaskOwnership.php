<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;

class CheckTaskOwnership
{
    public function handle(Request $request, Closure $next): Response
    {
        $taskRoute = $request->route('task');
        $task = $taskRoute instanceof Task ? $taskRoute : Task::find($taskRoute);

        if (! Auth::check() || ! $task || Auth::id() !== $task->user_id) {
            abort(403, 'Unauthorized access to this task');
        }

        return $next($request);
    }
}

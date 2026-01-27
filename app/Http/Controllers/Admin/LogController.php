<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $logPath = storage_path('logs/laravel.log');
        $logs = [];
        $date = $request->input('date', date('Y-m-d'));

        if (File::exists($logPath)) {
            $fileContents = File::get($logPath);
            $lines = explode("\n", $fileContents);
            
            // Pattern to match log entries starting with [YYYY-MM-DD
            $pattern = "/^\[" . preg_quote($date) . "/";

            foreach ($lines as $line) {
                if (preg_match($pattern, $line)) {
                    $logs[] = $line;
                }
            }
            
            // Reverse to show latest first
            $logs = array_reverse($logs);
        }

        return view('dashboards.admin.logs.index', compact('logs', 'date'));
    }
}

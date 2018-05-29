<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function warn(Exception $qe)
    {
        $logMessage = "\nID: " . Auth::user()->id . "\n" . $qe->getMessage() . "\n" . $qe->getTraceAsString() . "\n\n";
        Log::warning($logMessage);
    }

    public function error(Exception $qe)
    {
        $logMessage = "\nID: " . Auth::user()->id . "\n" . $qe->getMessage() . "\n" . $qe->getTraceAsString() . "\n\n";
        Log::error($logMessage);
    }
}

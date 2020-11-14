<?php

namespace App\Exceptions;

use App\Patient;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Throwable;

class DuplicateKPIC extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function render(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Duplicate KPIC Found! Please resubmit with a new icon selected'
            ], 400);
        }

        return redirect()->back()->with('warning_kpic_duplicate', Patient::findOrFail($this->getMessage()))->withInput();
    }
}

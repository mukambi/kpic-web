<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class UserDeactivated extends Exception
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
     * @return Application|Factory|JsonResponse|View
     */
    public function render(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'message' => $this->getMessage()
            ]);
        }

        return view('errors.deactivated', [
            'message' => $this->getMessage()
        ]);
    }
}

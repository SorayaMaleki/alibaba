<?php

namespace App\Http\Responses;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

trait StandardResponse
{
    /**
     * @param string $route
     * @param array $data
     * @param string|null $message
     * @return View
     */
    public function viewResponse(string $route, array $data = [], string $message = null): View
    {
        return view(self::ROUTE . $route, $data)->with('message', $message);
    }

    /**
     * @param string $route
     * @param array $data
     * @param string|null $message
     * @return RedirectResponse
     */
    public function redirectResponse(string $route, array $data = [], string $message = null): RedirectResponse
    {
        return redirect()->route(self::ROUTE . $route, $data)->with('message', $message);
    }
}

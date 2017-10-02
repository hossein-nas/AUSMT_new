<?php

namespace App\Http\Middleware;

use Closure;

class VisitPagesMW
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null $record_id
     * @return mixed
     */
    public function handle($request, Closure $next, $record_id = null)
    {
        $visit = new \App\Models\Records\Visit;
        $visit->record_id = $record_id;
        $visit->ip = $request->ip();
        $visit->uri = $request->getRequestUri();
        $visit->request_time = $request->server->get('REQUEST_TIME');
        $visit->user_agent = $request->header('User-Agent');
        $visit->redirect_uri = $request->server('HTTP_REFERER');
//        dd($visit);
        $visit->save();
        return $next($request);
    }
}

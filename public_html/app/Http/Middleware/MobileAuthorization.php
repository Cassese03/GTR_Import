<?php

namespace App\Http\Middleware;

use App\Models\Agente;
use Closure;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class MobileAuthorization  {
    public function handle(Request $request, Closure $next)
    {
        if($this->agenteAreEnabled($request)<=0) {
            return response('{"error": "test"}', 401);
        }
        return $next($request);
       /* if($this->agenteAreEnabled().){
            return $next($request);
        }
        return redirect('home')->with('error','Permission Denied!!! You do not have administrative access.'); */
    }

    private function checkDitta(Request $request) {
        return  ['id_ditta', '=', $request->header('TOKEN')];
    }

    private function deleteFittizi() {
        return ['fittizio', '=' , 0];
    }

    private function checkAgente() {
        return ['cd_agente', '=' , $this->getAgente()];
    }

    private function getAgente() {

        $json = file_get_contents('php://input');
        $dati = json_decode($json, true);

        return $dati["cd_agente"];
    }

    private function agenteAreEnabled(Request $request) {
        return Agente::where([$this->checkAgente(), $this->checkDitta($request)])->count();
    }
}

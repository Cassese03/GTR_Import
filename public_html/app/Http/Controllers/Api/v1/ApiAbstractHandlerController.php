<?php
namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Agente;
use App\Models\AR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Illuminate\Support\Facades\Http;


abstract class ApiAbstractHandlerController extends Controller
{

    abstract public function getAR(Request $request);


    /*
        abstract public function getIdDitta();

        abstract public function getViewAR();

        public function getAR(Request $request) {

            return DB::table($this->getViewAR())
                ->select("*")
                ->join('arclasse1', $this->getViewAR() . '.cd_arclasse1', '=', 'arclasse1.cd_arclasse1')
                ->get();

            //return response()->json($list_ar, 200, [], JSON_PRETTY_PRINT);
        }

        private function checkDitta($table) {
            return  [$table . '.id_ditta', '=', $this->getIdDitta()];
        }

        private function checkFittizi($value) {
            return ['fittizio', '=' , $value];
        }

    private function checkAgente() {
        return ['cd_agente', '=' , $this->getAgente()];
    }

        private function getAgente() {

            $json = file_get_contents('php://input');
            $dati = json_decode($json, true);

            return $dati["cd_agente"];
        }

        private function agenteAreEnabled() {
           return Agente::where([$this->checkAgente(), $this->checkDitta()])->get();
        }

    */
}
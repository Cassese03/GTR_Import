<?php
namespace App\Http\Controllers\Api\v1;

use App\Models\Damarila\ARDamarila;
use Illuminate\Http\Request;

class DamarilaController extends ApiAbstractHandlerController{
    public function getIdDitta() {
        return 5;
    }

    public function getViewAR()
    {
       return "ar_damarila";
    }

    public function getAR(Request $request)
    {
        /*return DB::table('ar_damarila', 'ar')
            ->leftJoin('arclasse1_damarila as classe1', 'classe1.cd_arclasse1', '=', 'ar.cd_arclasse1')
            ->select('*')

            ->get(); */
        return ARDamarila::all();
    }
}

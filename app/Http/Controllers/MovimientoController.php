<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\Request;
use App\Models\Cuenta;


class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pcliente, $pcuenta)
    {
        //
        $cadena ="";

        $cuenta = Cuenta::whereRaw(' numero = "' . $pcuenta . '"')->get()->first();

        if ($cuenta->cliente_id == $pcliente) {
            foreach ($cuenta->tarjetas as $tarjeta) {
                foreach ($tarjeta->movimientos as $movimiento) {
                    $cadena .= "Cliente:" . $movimiento->Cliente()->nombre . " >> cuenta: ".
                        $movimiento->cuenta->numero . " >> tarjeta:  " . $movimiento->tarjeta->numero .
                        " >> cantidad: " . $movimiento->cantidad . " €<br>";
                }
            }
            return $cadena;
        }

        return "";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sacarDinero(Request $request, $pcliente, $ptarjeta, $ppin)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function movimientoCajero($idTarjeta){
        $movimiento = new Movimiento();
        $movimiento->cantidad = request()->cantidad;
        $movimiento->tarjeta_id = $idTarjeta;
        $movimiento->fecha = now();
        //Comprobamos si: tiene saldo, existe la cuenta, la tarjeta no está expirada
        $movimiento->save();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Proyecto;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function generarFacturaPDF($proyectoId)
    {
        $proyecto = Proyecto::find($proyectoId);
        $cliente = Cliente::find($proyecto->cliente_id);
        $numeroFactura = mt_rand(1000000, 2000000);
        $fechaHoy = date('d-m-Y');

        $html = '
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-bottom: 50px; /* Espacio para el footer */
        }
        .invoice-container {
            border: 2px solid #000;
            padding: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            border-top: 2px solid #000;
            padding: 10px 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #000;
            padding: 8px;
        }
        .invoice-total {
            text-align: right;
        }
    </style>
    <div class="invoice-container">
        <h1 class="invoice-header">Factura</h1>
        <p class="invoice-subheader"><strong>Número de factura:</strong> ' . $numeroFactura . '</p>
        <p class="invoice-subheader"><strong>Fecha:</strong> ' . $fechaHoy . '</p>
        <div class="invoice-details">
            <p><strong>Nombre del proyecto:</strong> ' . $proyecto->nombre . '</p>
            <p><strong>Nombre del cliente:</strong> ' . $cliente->apellidos . ' ' . $cliente->nombres . '</p>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Sub total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Finalización proyecto: ' . $proyecto->nombre . '</td>
                    <td>' . $proyecto->ingresos_proyectados . '</td>
                </tr>
            </tbody>
            <tfoot class="invoice-footer">
                <tr>
                    <td class="invoice-total"><strong>Total:</strong></td>
                    <td><strong>$' . $proyecto->ingresos_proyectados . '</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    
';

$options = new Options();
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);

$dompdf->render();

return $dompdf->stream("factura.pdf");

    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;

class ShippingLabelController extends Controller
{
    //
    public function generateLabel($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Generate barcode
        $barcodeGenerator = new DNS1D();
        $barcode = $barcodeGenerator->getBarcodePNG($order->order_id, 'C128', 2, 50);
        
        // Load the PDF
        $pdf = Pdf::loadView('backend.order.label', compact('order', 'barcode'));
        // return view('backend.order.label', compact('order', 'barcode'));

        // Download PDF
        return $pdf->download('shipping_label_' . $order->order_id . '.pdf');
    }
}

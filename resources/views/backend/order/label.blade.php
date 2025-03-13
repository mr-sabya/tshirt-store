<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h5 {
            font-weight: bold;
            font-size: 16px;
            margin: 0;
            margin-bottom: 5px;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .label-container {
            width: 450px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 2px solid #000;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }

        .header h2 {
            font-size: 18px;
            margin: 0;
        }

        .info {
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 15px;
            border-bottom: 1px dashed #000;
            padding-bottom: 8px;
        }

        .info strong {
            font-size: 15px;
        }

        .barcode {
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            border-top: 1px dashed #000;
        }

        .barcode img {
            max-width: 100%;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 10px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="label-container">
        <!-- Header with Logo -->
        <div class="header">
            <img src="{{ public_path('storage/'. $settings->logo) }}" alt="Company Logo">
            <h2>Shipping Label</h2>
        </div>

        <!-- Sender & Receiver Info -->
        <div class="info">
            <h5>Ship From</h5>
            <p>{{ $settings->site_name }}</p>
            <p>{{ $settings->address }}</p>
            <p>{{ $settings->email }}</p>
            <p>{{ $settings->phone }}</p>
        </div>

        <div class="info">
            <h5>Ship To</h5>
            <p>{{ $order->user['name'] }}</p>
            <p>{{ $order->user['phone'] }}</p>
            <p>{{ $order->user['address'] }}</p>

        </div>

        <p style="margin-bottom: 5px;"><strong>Order ID:</strong> {{ $order->order_id }}</p>
        <p style="margin-bottom: 5px;"><strong>Invoice No:</strong> {{ $order->invoice_no }}</p>
        <p style="margin-bottom: 5px;"><strong>Package Weight:</strong> 100gm</p>
        <p style="margin-bottom: 5px;"><strong>Dimentions:</strong> 1incX12icnX2inc</p>
        <p style="margin-bottom: 5px;"><strong>Shipping Date:</strong> 100gm</p>

        <!-- Barcode Section -->
        <div class="barcode">
            <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode">
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Product Barcodes</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .page {
            width: 100%;
            height: 100%;
            padding: 10mm;
        }
        .barcode-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10mm; /* Add some space between the labels */
        }
        .barcode-item {
            width: 40mm;
            height: 30mm;
            box-sizing: border-box;
            padding: 3px;
            text-align: center;
            border: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            page-break-inside: avoid;
        }
        .barcode-item img {
            width: 100%;
            height: auto;
            margin: 2mm 0;
        }
        .barcode-item p {
            margin: 0;
            font-size: 9px;
            line-height: 1.2;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="barcode-container">
            @foreach($products as $product)
            <div class="barcode-item">
                <p>{{ $product->product_name }}</p>
                <p>{{ $product->selling_price }} Ks</p>
                <img src="data:image/png;base64,{{ $product->barcode_image }}" alt="Barcode">
                <p>{{ $product->product_code }}</p>
            </div>
        @endforeach

        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>

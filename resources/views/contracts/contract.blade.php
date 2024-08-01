<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Sözleşmesi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px; 
        }
        .header h1 {
            margin: 10px 0;
            font-size: 24px;
            font-weight: bold;
        }
        .date {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 14px;
            color: #333;
        }
        .content {
            margin-bottom: 40px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            text-align: right;
            font-size: 16px;
            margin-top: 40px;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="date">
            {{ \Carbon\Carbon::now()->format('d-m-Y') }} 
        </div>
        <div class="header">
            <img src="https://macellan.net/image/macellan-logo-v2.svg" alt="Logo"> 
            <h1>Macellan Kutuphanesi</h1>
        </div>
        <div class="content">
            <p>Merhaba Turkiye halki, benim adim <strong>{{ $name }}</strong>. 
                Macellan kutuphanesinden {{ \Carbon\Carbon::now()->format('d-m-Y') }}  tarihinde  <strong>{{ $bookName }}</strong> adli kitabi odunc aldim.
                Macellan kutuphanesinden aldigim bu kitabi  <strong>{{ $deliveryDate }}</strong> tarihine kadar getirecegime and icerim. 
            </p>
           
        </div>
        <div class="footer">
            <p>Imza:</p> <br>
            <p>____________________</p>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h2 > span{
            color: rgb(0, 72, 206);
            text-align: center;
            font-size: 20px;
        }
        .otp-container {
            padding: .5rem 1.5rem;
            border: 1px solid rgba(0, 21, 139, 0.356);
            border-radius: 3px;
            margin: auto;
            width: 100%;
            background: rgba(0, 174, 255, 0.11);
        } 
        .otp-container > p {
            width: 100%;
            text-align: center;
            font-weight: bold;
            font-size: 28px;
            letter-spacing: 0.25rem;
        }
    </style>
</head>
<body>
    <h2>Welcome to <span>eAtihi</span></h2>
    <hr>
    <h3 style="text-align: center">Your One Time Password (OTP) :</h3>
    <div 
        style="
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        ">
        <div class="otp-container">
            <p>{{ $mailData['otp'] }}</p>
        </div>
    </div>
    <br>
    <p>This OTP is for verifying your email address.</p>
    <p>Thanks</p>
</body>
</html>
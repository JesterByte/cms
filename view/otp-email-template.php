<?php 
    date_default_timezone_set("Asia/Manila"); 
    $currentYear = date("Y");    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header img {
            width: 100px;
        }
        .email-body {
            text-align: center;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #333333;
            margin: 20px 0;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #888888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Green Haven Memorial Park</h1>
        </div>
        <div class="email-body">
            <h2>OTP Verification Code</h2>
            <p>Dear [User Name],</p>
            <p>Use the following One-Time Password (OTP) to complete your verification process:</p>
            <div class="otp-code">
                [OTP_CODE]
            </div>
            <p>This OTP is valid for 5 minutes.</p>
        </div>
        <div class="email-footer">
            <p>&copy; Green Haven Memorial Park. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
            padding: 20px;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: #ffffff;
        }
        .email-header h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .email-header p {
            font-size: 14px;
            opacity: 0.9;
        }
        .email-body {
            padding: 40px 30px;
        }
        .info-section {
            margin-bottom: 30px;
        }
        .info-row {
            display: flex;
            padding: 15px;
            margin-bottom: 12px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
            min-width: 100px;
            font-size: 14px;
        }
        .info-value {
            color: #212529;
            flex: 1;
            font-size: 14px;
        }
        .message-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            border-left: 4px solid #667eea;
        }
        .message-box h3 {
            color: #495057;
            font-size: 16px;
            margin-bottom: 12px;
            font-weight: 600;
        }
        .message-content {
            color: #212529;
            font-size: 14px;
            line-height: 1.8;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .email-footer p {
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 8px;
        }
        .reply-button {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
        }
        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 25px 0;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                border-radius: 0;
            }
            .email-header {
                padding: 30px 20px;
            }
            .email-body {
                padding: 30px 20px;
            }
            .info-row {
                flex-direction: column;
            }
            .info-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>📧 New Contact Message</h1>
            <p>You have received a new message from your portfolio website</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="info-section">
                <div class="info-row">
                    <span class="info-label">👤 Name:</span>
                    <span class="info-value">{{ $details['name'] }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">✉️ Email:</span>
                    <span class="info-value">{{ $details['email'] }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">📋 Subject:</span>
                    <span class="info-value">{{ $details['subject'] }}</span>
                </div>
            </div>

            <div class="divider"></div>

            <div class="message-box">
                <h3>💬 Message:</h3>
                <div class="message-content">{{ $details['message'] }}</div>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <a href="mailto:{{ $details['email'] }}?subject=Re: {{ $details['subject'] }}" class="reply-button">
                    Reply to {{ $details['name'] }}
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>This message was sent from your portfolio contact form</p>
            <p style="font-size: 12px; color: #adb5bd;">{{ now()->format('F d, Y \\a\\t h:i A') }}</p>
        </div>
    </div>
</body>
</html>

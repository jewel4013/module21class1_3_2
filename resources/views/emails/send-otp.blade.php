<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #eef2f5;">
        
        <!-- 🛒 টপ ব্র্যান্ড হেডার (Shwapno POS Theme) -->
        <tr>
            <td style="background-color: #212529; padding: 32px; text-align: center; border-bottom: 3px solid #198754;">
                <h2 style="margin: 0; color: #198754; font-weight: 800; letter-spacing: 1px; font-size: 28px;">
                    🛒 SHWAPNO <span style="background-color: #198754; color: #ffffff; font-size: 14px; padding: 4px 8px; border-radius: 6px; vertical-align: middle; margin-left: 6px;">POS</span>
                </h2>
                <p style="margin: 6px 0 0 0; color: #adb5bd; font-size: 13px; text-uppercase; tracking-wider;">Central Inventory Management Portal</p>
            </td>
        </tr>

        <!-- 📄 মূল কন্টেন্ট বডি -->
        <tr>
            <td style="padding: 40px 32px; color: #333333;">
                <h4 style="margin: 0 0 16px 0; color: #212529; font-size: 20px; font-weight: 700;">Password Reset Request</h4>
                <p style="margin: 0 0 24px 0; color: #6c757d; font-size: 15px; line-height: 1.6;">
                    Hello <strong>Store Keeper</strong>,<br>
                    We received a request to reset the password for your Shwapno POS account. Use the verification code below to proceed with resetting your credentials.
                </p>
            </td>
        </tr>
        <!-- 🔑 ওটিপি কোড ডিসপ্লে জোন -->
        <tr>
            <td style="padding: 0 32px 24px 32px; text-align: center;">
                <div style="background-color: #f8f9fa; border: 1px dashed #198754; border-radius: 12px; padding: 24px; display: inline-block; min-width: 260px;">
                    <span style="display: block; color: #6c757d; font-size: 12px; text-transform: uppercase; font-weight: bold; letter-spacing: 1px; margin-bottom: 8px;">Your Verification Code</span>
                    <span style="font-family: 'Courier New', Courier, monospace; font-size: 36px; font-weight: 800; color: #198754; letter-spacing: 6px;">{{ $otp ?? '1234' }}</span>
                </div>
            </td>
        </tr>

        <!-- ⚠️ সিকিউরিটি ওয়ার্নিং ও এক্সপায়্যার নোটিশ -->
        <tr>
            <td style="padding: 0 32px 40px 32px; color: #333333;">
                <div style="background-color: #fff3cd; border-radius: 8px; padding: 12px 16px; border-left: 4px solid #ffc107; margin-bottom: 24px;">
                    <p style="margin: 0; color: #664d03; font-size: 13px; line-height: 1.5;">
                        <strong>Note:</strong> This verification code is valid for the next <strong>15 minutes</strong> only. For security reasons, do not share this code with anyone.
                    </p>
                </div>
                
                <p style="margin: 0; color: #6c757d; font-size: 14px; line-height: 1.6;">
                    If you did not request a password reset, please ignore this email or contact the central system administrator immediately. Your account remains secure.
                </p>
            </td>
        </tr>

        <!-- 🏢 ইমেইল ফুটার অংশ -->
        <tr>
            <td style="background-color: #f8f9fa; padding: 24px; text-align: center; border-top: 1px solid #eef2f5;">
                <p style="margin: 0 0 6px 0; color: #212529; font-size: 12px; font-weight: bold;">Shwapno Retail Ltd.</p>
                <p style="margin: 0; color: #9aa2af; font-size: 11px;">
                    This is an automated system notification. Please do not reply directly to this email.
                </p>
            </td>
        </tr>

    </table>

</body>
</html>

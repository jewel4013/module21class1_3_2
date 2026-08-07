<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>সেলস রিপোর্ট</title>
    
    <style>
        /* ১. SolaimanLipi ফন্টটি ডিফাইন করা */
    
        @font-face {
            font-family: 'SolaimanLipi';
            /* শুধু ফাইলের নাম দিন, কন্ট্রোলার বাকি পাথ খুঁজে নেবে */
            src: url('SolaimanLipi.ttf') format('truetype'); 
            font-weight: normal;
            font-style: normal;
        }

          

        /* ২. পুরো বডিতে ফন্টটি অ্যাপ্লাই করা */
        body {
            font-family: 'SolaimanLipi', sans-serif;
            font-size: 14px;
            color: #333;
        }

        /* বুটস্ট্র্যাপের অন্যান্য কাস্টম সিএসএস */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h2>সেলস রিপোর্ট (বাংলায়)</h2>
    <p>আজকের মোট বিক্রয় তালিকা এবং বিবরণ নিচে দেওয়া হলো:</p>

    <table>
        <thead>
            <tr>
                <th>আইটেম নাম</th>
                <th>পরিমাণ</th>
                <th>মূল্য</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>স্মার্টফোন (স্যামসাং)</td>
                <td>২টি</td>
                <td>৳ ৪৫,০০০</td>
            </tr>
            <tr>
                <td>হেডফোন (সনি)</td>
                <td>৫টি</td>
                <td>৳ ১২,৫০০</td>
            </tr>
        </tbody>
    </table>

</body>
</html>

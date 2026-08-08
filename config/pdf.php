<?php

return [
    'mode'                     => 'utf-8',
    'format'                   => 'A4',
    'default_font_size'        => '12',
    'default_font'             => 'solaimanlipi', // ডিফল্ট ফন্ট হিসেবে সেট করুন
    'margin_left'              => 15,
    'margin_right'             => 15,
    'margin_top'               => 15,
    'margin_bottom'            => 15,
    'margin_header'            => 0,
    'margin_footer'            => 0,
    'orientation'              => 'P',
    'title'                    => 'Laravel PDF',
    'author'                   => '',
    'watermark'                => '',
    'show_watermark'           => false,
    'show_watermark_image'     => false,
    'watermark_font'           => 'sans-serif',
    'display_mode'             => 'fullpage',
    'watermark_text_alpha'     => 0.1,
    'watermark_image_path'     => '',
    'watermark_image_alpha'    => 0.2,
    'watermark_image_size'     => 'D',
    'watermark_image_position' => 'P',
    'custom_font_dir'          => public_path('fonts/'), // ফন্ট ফোল্ডারের পাথ
    'custom_font_data'         => [
        'solaimanlipi' => [
            'R'          => 'SolaimanLipi_22-02-2012.ttf', // ফন্ট ফাইলের নাম
            //'B'          => 'SolaimanLipi_Bold_10-03-12.ttf', // বাইনামেট ফন্ট ফাইলের নাম
            'useOTL'     => 0xFF,               // যুক্তাক্ষর ঠিক রাখার জন্য জরুরি
            'useKashida' => 75,
        ]
    ],
    'auto_language_detection'  => true,
    'temp_dir'                 => storage_path('app'),
    'pdfa'                     => false,
    'pdfaauto'                 => false,
    'use_active_forms'         => false,
];

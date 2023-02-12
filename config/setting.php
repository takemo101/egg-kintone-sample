<?php

/**
 * その他設定
 */
return [
    // リソースデータを格納するディレクトリパス
    'resource-path' => 'resource',

    // latteのテンプレートを格納するディレクトリパス
    'latte-path' => 'resource/latte',

    // latteのキャッシュを格納するディレクトリパス
    // ストレージディレクトリからの相対パス
    'latte-cache-path' => 'cache/latte',

    // ブログのパスワード
    'blog-password' => env('BLOG_PASSWORD', 'blog'),
    'blog-app-id' => env('BLOG_APP_ID', 1),

    // KintoneのApiトークン
    'kintone' => [
        'api-token' => env('KINTONE_API_TOKEN', ''),
        'subdomain' => env('KINTONE_SUBDOMAIN', ''),
    ],
];

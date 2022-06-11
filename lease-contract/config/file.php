<?php

return [
    'allowed_mime_types'      => env('PLUGIN_LEASE_CONTRACT_FILE_ALLOWED_MIME_TYPES',
        'jpg,jpeg,png,bmp,docx,doc,xls,xlsx,zip,rar,pdf,'),
    'mime_types'              => [
        'image'    => [
            'image/png',
            'image/jpeg',
            'image/bmp',
        ],
        'document' => [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ],
        'archived' => [
            'application/zip',
            'application/vnd.rar',
            'application/x-gzip',
        ],
    ],
    'max_file_size_upload'    => env('PLUGIN_LEASE_CONTRACT_FILE_MAX_FILE_SIZE_UPLOAD', 25 * 1024 * 1024), // Maximum size to upload
    'sizes'                   => [
        'thumb' => '150x150',
    ],
    'accept' => 'application/zip, application/vnd.rar, application/pdf, image/jpeg, image/png, image/bmp, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document,',
];
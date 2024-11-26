<?php

return [
    'credentials' => [
        'file' => env('FIREBASE_CREDENTIALS'),
    ],
    'database' => [
        'project_id' => env('FIREBASE_PROJECT_ID'),
    ],
];

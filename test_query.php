<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $records = \App\Models\PageVisit::selectRaw('MAX(id) as id, page_name, url, COUNT(*) as visit_count, MAX(created_at) as last_visited')
        ->groupBy('page_name', 'url')
        ->orderByDesc('visit_count')
        ->get();
        
    echo "Query runs OK.\n";
    foreach ($records as $record) {
        echo "Key: " . ($record->getKey() ?? 'NULL') . "\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

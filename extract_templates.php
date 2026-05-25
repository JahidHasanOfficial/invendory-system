<?php

$templateDir = 'E:/laravel-e-learning/invendory-system/Inventory-Desing-Template';
$viewsDir = 'E:/laravel-e-learning/invendory-system/resources/views/admin';

$mapping = [
    'approval-logs.html' => 'reports/approval-logs.blade.php',
    'asset-assignments.html' => 'assets/asset-assignments.blade.php',
    'audit-log.html' => 'reports/audit-log.blade.php',
    'backup.html' => 'settings/backup.blade.php',
    'goods-receipts.html' => 'vendors/goods-receipts.blade.php',
    'issues.html' => 'transfers/issues.blade.php',
    'lab-stock.html' => 'stocks/lab-stock.blade.php',
    'notifications.html' => 'dashboard/notifications.blade.php',
    'purchase-orders.html' => 'vendors/purchase-orders.blade.php',
    'returns.html' => 'transfers/returns.blade.php',
    'stock-movements.html' => 'stocks/stock-movements.blade.php',
    'supplier-products.html' => 'vendors/supplier-products.blade.php',
    'voucher-types.html' => 'settings/voucher-types.blade.php',
];

foreach ($mapping as $htmlFile => $bladeFile) {
    $htmlPath = "$templateDir/$htmlFile";
    $bladePath = "$viewsDir/$bladeFile";
    
    if (!file_exists($htmlPath)) {
        echo "Missing: $htmlFile\n";
        continue;
    }
    
    $htmlContent = file_get_contents($htmlPath);
    
    // Extract page title from title tag or header
    preg_match('/<title>(.*?)<\/title>/', $htmlContent, $titleMatches);
    $pageTitle = isset($titleMatches[1]) ? explode('|', $titleMatches[1])[0] : 'Admin';
    $pageTitle = trim($pageTitle);

    // Extract main content
    // We are looking for: <div class="flex-grow-1"> ... </div> (the one containing the actual page content)
    $contentStart = strpos($htmlContent, '<div class="flex-grow-1">');
    if ($contentStart === false) {
        echo "No flex-grow-1 found in $htmlFile\n";
        continue;
    }
    
    // Skip the opening div tag
    $contentStart += strlen('<div class="flex-grow-1">');
    
    // Find where the main-content div ends.
    // Usually it's followed by:
    //         </div>
    //     </div>
    // </div>
    // <!-- Bootstrap 5 JS Bundle -->
    $contentEnd = strpos($htmlContent, '<!-- Bootstrap 5 JS Bundle -->', $contentStart);
    if ($contentEnd === false) {
        echo "No Bootstrap JS Bundle comment found in $htmlFile\n";
        continue;
    }
    
    // We need to back up to close the flex-grow-1 div and main-content
    $extractedHtml = substr($htmlContent, $contentStart, $contentEnd - $contentStart);
    // Remove the trailing </div></div></div>
    $extractedHtml = preg_replace('/<\/div>\s*<\/div>\s*<\/div>\s*$/', '', $extractedHtml);
    
    // Extract specific scripts (not the bootstrap bundle or layout toggle)
    $scriptsStart = strpos($htmlContent, '<script>', $contentEnd);
    $customScripts = '';
    
    if ($scriptsStart !== false) {
        // Find if there are any specific scripts for this page like charts
        preg_match_all('/<script.*?>.*?<\/script>/is', substr($htmlContent, $contentEnd), $scriptMatches);
        foreach ($scriptMatches[0] as $script) {
            // Ignore the layout scripts
            if (strpos($script, 'sidebarToggle') === false && strpos($script, 'bootstrap.bundle.min.js') === false) {
                $customScripts .= "\n" . $script;
            }
        }
    }
    
    // Prepare the blade content
    $bladeContent = "@extends('layouts.app')\n\n";
    $bladeContent .= "@section('page_title', '$pageTitle')\n\n";
    $bladeContent .= "@section('content')\n";
    $bladeContent .= trim($extractedHtml) . "\n";
    $bladeContent .= "@endsection\n";
    
    if (!empty(trim($customScripts))) {
        $bladeContent .= "\n@stack('scripts')\n";
        $bladeContent .= trim($customScripts) . "\n";
    }
    
    // Ensure directory exists
    $dir = dirname($bladePath);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    
    file_put_contents($bladePath, $bladeContent);
    echo "Processed: $htmlFile -> $bladeFile\n";
}

echo "Done!\n";

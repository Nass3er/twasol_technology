# Fix all dd($e) statements in controllers
# This script removes problematic dd($e) debug statements that cause 500 errors on cloud

$controllers = @(
    "app\Http\Controllers\Admin\SalesAndMarketing\ProductsController.php",
    "app\Http\Controllers\Admin\SalesAndMarketing\HadhramiController.php",
    "app\Http\Controllers\Admin\SalesAndMarketing\CustomerServiceController.php",
    "app\Http\Controllers\Admin\MediaCenter\PhotosGalaryController.php",
    "app\Http\Controllers\Admin\Home\StartUpController.php",
    "app\Http\Controllers\Admin\ExternalLinks\ExternalLinksController.php",
    "app\Http\Controllers\Admin\ElectronicServices\JobApplicaitonController.php",
    "app\Http\Controllers\Admin\AboutUs\SocialResponsibilityController.php",
    "app\Http\Controllers\Admin\AboutUs\OurProjectController.php",
    "app\Http\Controllers\Admin\AboutUs\EnvironmentController.php"
)

foreach ($controller in $controllers) {
    $filePath = Join-Path $PSScriptRoot $controller
    
    if (Test-Path $filePath) {
        Write-Host "Processing: $controller" -ForegroundColor Yellow
        
        # Read file content
        $content = Get-Content $filePath -Raw
        
        # Replace dd($e); with comment
        $newContent = $content -replace 'dd\(\$e\);', '// dd($e); // Removed to prevent 500 errors on cloud'
        
        # Also remove the optimizer code blocks
        $newContent = $newContent -replace '(?s)// 4\) \(Optional\) Optimize original with spatie/image-optimizer.*?// swallow optimization errors.*?\}', '// 4) (Optional) Optimize original - Disabled to avoid cloud server issues
                    // Image optimization requires external binaries that may not be available on cloud
                    // The images are already optimized by GD during thumbnail creation'
        
        # Write back
        Set-Content -Path $filePath -Value $newContent -NoNewline
        
        Write-Host "✓ Fixed: $controller" -ForegroundColor Green
    } else {
        Write-Host "✗ Not found: $controller" -ForegroundColor Red
    }
}

Write-Host "`n✨ All controllers have been fixed!" -ForegroundColor Cyan
Write-Host "Please test the application on cloud after deploying these changes." -ForegroundColor Yellow

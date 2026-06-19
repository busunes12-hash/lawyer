# setup_wordpress.ps1
# PowerShell script to download and extract WordPress core and SQLite Database Integration on Windows.

$ErrorActionPreference = "Stop"

Write-Host "1. Downloading WordPress Core..." -ForegroundColor Green
curl.exe -L "https://wordpress.org/latest.zip" -o "wordpress_latest.zip"

Write-Host "2. Extracting WordPress Core..." -ForegroundColor Green
if (Test-Path "wordpress_latest.zip") {
    Expand-Archive -Path "wordpress_latest.zip" -DestinationPath "." -Force
} else {
    Write-Error "WordPress ZIP file not found."
}

Write-Host "3. Moving files to root directory..." -ForegroundColor Green
if (Test-Path "wordpress") {
    Get-ChildItem -Path "wordpress\*" | ForEach-Object {
        $dest = Join-Path "." $_.Name
        if (Test-Path $dest) {
            Remove-Item -Path $dest -Recurse -Force
        }
        Move-Item -Path $_.FullName -Destination "." -Force
    }
    Remove-Item -Path "wordpress" -Recurse -Force
}

Write-Host "4. Cleaning up WordPress ZIP..." -ForegroundColor Green
Remove-Item -Path "wordpress_latest.zip" -Force

Write-Host "5. Downloading SQLite Database Integration Plugin..." -ForegroundColor Green
curl.exe -L "https://downloads.wordpress.org/plugin/sqlite-database-integration.latest.zip" -o "sqlite_integration.zip"

Write-Host "6. Extracting SQLite Integration Plugin..." -ForegroundColor Green
if (!(Test-Path "wp-content/plugins")) {
    New-Item -ItemType Directory -Path "wp-content/plugins" -Force
}
Expand-Archive -Path "sqlite_integration.zip" -DestinationPath "wp-content/plugins" -Force
Remove-Item -Path "sqlite_integration.zip" -Force

Write-Host "7. Setting up SQLite db.php drop-in..." -ForegroundColor Green
$dbCopyPath = "wp-content/plugins/sqlite-database-integration/db.copy"
$dbPhpPath = "wp-content/db.php"
if (Test-Path $dbCopyPath) {
    Copy-Item -Path $dbCopyPath -Destination $dbPhpPath -Force
    Write-Host "SQLite integration is successfully configured." -ForegroundColor Green
} else {
    Write-Warning "sqlite-database-integration/db.copy not found! Setup might be incomplete."
}

# Delete the temporary setup_wordpress.php
if (Test-Path "setup_wordpress.php") {
    Remove-Item "setup_wordpress.php" -Force
}

Write-Host "WordPress + SQLite setup complete!" -ForegroundColor Green

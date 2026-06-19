<?php
// setup_wordpress.php
// Automation script to fetch and set up WordPress with SQLite on Windows.

echo "Starting WordPress + SQLite setup...\n";

// Helper function to download a file
function downloadFile($url, $filepath) {
    echo "Downloading $url to $filepath...\n";
    $ch = curl_init($url);
    $fp = fopen($filepath, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // Disable SSL verification if needed, but try default first
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    return $result;
}

// Download WordPress Core
$wp_zip = 'wordpress_latest.zip';
if (!file_exists($wp_zip)) {
    downloadFile('https://wordpress.org/latest.zip', $wp_zip);
}

// Extract WordPress Core
echo "Extracting WordPress Core...\n";
$zip = new ZipArchive;
if ($zip->open($wp_zip) === TRUE) {
    $zip->extractTo(__DIR__);
    $zip->close();
    echo "WordPress Core extracted successfully.\n";
} else {
    die("Error: Failed to open $wp_zip\n");
}

// Move files from 'wordpress' folder to root
echo "Moving WordPress files to current directory...\n";
$src_dir = __DIR__ . '/wordpress';
$dest_dir = __DIR__;

function moveFiles($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                moveFiles($src . '/' . $file, $dst . '/' . $file);
            } else {
                rename($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

if (is_dir($src_dir)) {
    moveFiles($src_dir, $dest_dir);
    // Remove the empty directory
    function deleteDir($dirPath) {
        if (!is_dir($dirPath)) {
            return;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    deleteDir($src_dir);
    echo "Moved all files and cleaned up 'wordpress' directory.\n";
}

// Create wp-content/plugins if not exists
@mkdir(__DIR__ . '/wp-content/plugins', 0755, true);

// Download SQLite Database Integration plugin
$sqlite_zip = 'sqlite_integration.zip';
if (!file_exists($sqlite_zip)) {
    downloadFile('https://downloads.wordpress.org/plugin/sqlite-database-integration.latest.zip', $sqlite_zip);
}

// Extract SQLite Integration plugin
echo "Extracting SQLite Integration plugin...\n";
if ($zip->open($sqlite_zip) === TRUE) {
    $zip->extractTo(__DIR__ . '/wp-content/plugins');
    $zip->close();
    echo "SQLite Integration plugin extracted.\n";
} else {
    die("Error: Failed to open $sqlite_zip\n");
}

// Copy db.copy to db.php
echo "Setting up SQLite db.php drop-in...\n";
$db_copy_path = __DIR__ . '/wp-content/plugins/sqlite-database-integration/db.copy';
$db_php_path = __DIR__ . '/wp-content/db.php';
if (file_exists($db_copy_path)) {
    if (copy($db_copy_path, $db_php_path)) {
        echo "Successfully copied db.copy to db.php.\n";
    } else {
        echo "Failed to copy db.copy to db.php.\n";
    }
} else {
    echo "Warning: db.copy not found at $db_copy_path!\n";
}

// Clean up ZIP files
unlink($wp_zip);
unlink($sqlite_zip);

echo "WordPress and SQLite plugin structure is set up.\n";
?>

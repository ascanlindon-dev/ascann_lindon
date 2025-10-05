<?php
// Safely remove UTF-8 BOM or leading whitespace before <?php in PHP files.
// Creates a .bak backup before modifying.
$root = __DIR__ . "/..";
$ignoreDirs = ['vendor', '.git', 'node_modules', 'runtime', 'public'];
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
$modified = [];
foreach ($it as $file) {
    if (!$file->isFile()) continue;
    $path = $file->getPathname();
    if (strtolower(substr($path, -4)) !== '.php') continue;
    // skip ignored dirs
    $skip = false;
    foreach ($ignoreDirs as $d) {
        if (strpos($path, DIRECTORY_SEPARATOR . $d . DIRECTORY_SEPARATOR) !== false) { $skip = true; break; }
    }
    if ($skip) continue;
    $contents = file_get_contents($path);
    if ($contents === false) continue;
    $original = $contents;
    $changed = false;
    // remove BOM
    if (substr($contents,0,3) === "\xEF\xBB\xBF") {
        $contents = substr($contents,3);
        $changed = true;
    }
    // remove leading whitespace/newlines before <?php
    $pos = strpos($contents, '<?php');
    if ($pos !== false && $pos > 0) {
        $before = substr($contents, 0, $pos);
        if (preg_match('/^\s+$/', $before)) {
            $contents = substr($contents, $pos);
            $changed = true;
        }
    }
    if ($changed && $contents !== $original) {
        // backup
        copy($path, $path . '.bak');
        file_put_contents($path, $contents);
        $modified[] = $path;
    }
}
if (empty($modified)) {
    echo "No files needed fixing.\n";
    exit(0);
}
echo "Fixed files (backups saved with .bak):\n";
foreach ($modified as $m) echo " - $m\n";
exit(0);

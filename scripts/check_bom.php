<?php
// scans workspace for PHP files that start with a BOM or have leading whitespace before <?php
$root = __DIR__ . "/..";
$ignoreDirs = ['vendor', '.git', 'node_modules', 'runtime', 'public'];
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
$issues = [];
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
    $h = fopen($path, 'rb');
    if (!$h) continue;
    $chunk = fread($h, 512);
    fclose($h);
    // check BOM
    if (substr($chunk, 0, 3) === "\xEF\xBB\xBF") {
        $issues[] = [ 'file' => $path, 'problem' => 'UTF-8 BOM' ];
        continue;
    }
    // check leading whitespace before <?php
    // find first occurrence of <?php
    $pos = strpos($chunk, '<?php');
    if ($pos !== false && $pos > 0) {
        // check if the bytes before <?php contain only whitespace/newlines
        $before = substr($chunk, 0, $pos);
        if (preg_match('/^\s+$/', $before)) {
            $issues[] = [ 'file' => $path, 'problem' => 'Leading whitespace before <?php' ];
            continue;
        }
    }
}
if (empty($issues)) {
    echo "No BOM or leading-whitespace issues found in scanned PHP files.\n";
    exit(0);
}
echo "Found files with BOM or leading whitespace before <?php:\n";
foreach ($issues as $i) {
    echo " - {$i['file']} : {$i['problem']}\n";
}
exit(1);

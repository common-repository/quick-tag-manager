<?
include('../../functions.php');

// Keep only the file name (protect from "path injection")
$file = basename($_REQUEST['file']);

// The downloads dir is "downloads" inside "wp-content"
define('DOWNLOADS_PATH', dirname(QTM_DATA_DIR) . '/downloads');

if (!file_exists(DOWNLOADS_PATH . '/' . $file)) die('Not a valid file name');

$data = qtm_load('downloads');
  
if ($data[$file] != null) $data[$file]++;
else $data[$file] = 1;

qtm_store($data, 'downloads');

header('Location: ../../../../downloads/' . $file);
?>

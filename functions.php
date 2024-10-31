<?

// A directory where stgore some data collected by tags
define('QTM_DATA_DIR', dirname(dirname(dirname(__FILE__))) . '/qtm');

// Store an array on disk with the name passed. A file name called
// "$name".dat is created in the data dir
function qtm_store(&$arr, $name)
{
	$file = fopen(QTM_DATA_DIR . '/' . $name . '.dat', 'w');
	fwrite($file, serialize($arr));
	fclose($file);			
}

// Load an array from disk, looking for a file named "$name".dat
// in the data dir. If no file is found, return null.
function qtm_load($name)
{
  $file = QTM_DATA_DIR . '/' . $name . '.dat';
  if (file_exists($file)) return unserialize(file_get_contents(QTM_DATA_DIR . '/' . $name . '.dat'));
  else return null;
}

// Append a line of text to a text file.
function qtm_append($text, $name) {
  $file = fopen(QTM_DATA_DIR . '/' . $name . '.txt', 'a');
  fwrite($file, $text);
  fclose($file);
}

?>

<?php
header('Content-Type: application/json');

$data = $_POST['indata'];
$descriptorspec = array(
   0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
);

$process = proc_open('lexical', $descriptorspec, $pipes);
if(is_resource($process)) {

	fwrite($pipes[0], $data);
	fclose($pipes[0]);

	echo "[" . stream_get_contents($pipes[1]) . "]";
	fclose($pipes[1]);
	proc_close($process);
}



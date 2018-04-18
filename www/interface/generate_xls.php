<?php
function generate_xls($data,$filename) {
	if (!is_array($data)) return;
	if (!is_array($data[0])) return;
	header("Content-type:application/vnd.ms-excel");  
	header("Content-Disposition:attachment;filename=".$filename.".xls");  
	$tab="\t"; $br="\n";  
	echo implode($tab,array_keys($data[0])).$br;
	foreach($data as $v) {
		echo implode($tab,array_values($v)).$br;
		// foreach($v as $t) {
			// echo (string)$t.$tab;
		// }
		// echo $br;
	}
}
?>
<?php
function generate_xls($data,$filename,$title) {
	if (!is_array($data)) return;
	if (empty($data)) return;
	if (!is_array($data[0])) return;
	header("Content-type:application/vnd.ms-excel");  
	header("Content-Disposition:attachment;filename=".$filename.".xls");  
	$tab="\t"; $br="\n";  
	echo implode($tab,array_values($title)).$br;
	foreach($data as $v) {
		foreach($v as $t) {
			echo '="'.((string)$t).'"'.$tab;
		}
		echo $br;
	}
}
?>
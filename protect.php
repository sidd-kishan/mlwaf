<?php
$glob_check=[];
foreach (new DirectoryIterator('.') as $file) {
    if ($file->getExtension() === 'json'&&str_contains($file->getFilename(),"results")) {
        $array = json_decode(file_get_contents($file->getPathname()), true);
		$glob_check[$array['datasetName']]=$array['bestSolution']['solution'];
    }
}
foreach($_GET as $k=>$v){
	if(isset($glob_check[$k])&&!empty($glob_check[$k])){
		preg_match_all("/".($glob_check[$k])."/i", $v,$match,PREG_PATTERN_ORDER);
		$_GET[$k]=implode($match[0]);
	}
}
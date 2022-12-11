<?php
file_put_contents("logs/logs".time().".json",json_encode($_GET));
$glob_arr=[];
foreach (new DirectoryIterator('logs') as $file) {
    if ($file->getExtension() === 'json'&&str_contains($file->getFilename(),"logs")) {
        $array = json_decode(file_get_contents($file->getPathname()), true);
		foreach($array as $k=>$v){
			$glob_arr[$k][]=['string'=>$v,'match'=>['start'=>0,'end'=>strlen($v)]];
		}
    }
}
$arr=[];
foreach($glob_arr as $k=>$v)
{
	file_put_contents("logs"."$k".time().".json",json_encode(['name'=>$k,'description'=>'','examples'=>$v]));
}
<?php

function removeFolder($folder){
	if(is_dir($folder) == true){
			$folderContents = scandir($folder);
			unset($folderContents[0], $folderContents[1]);
			echo $folder;

			foreach ($folderContents  as $content  => $contentName) {
					$currentPath = $folder.'/'.$contentName;
					 $filetpe = filetype($currentPath);
					//  echo $contentName;
					 if($filetpe == 'dir'){
						 	removeFolder($currentPath);
					 }else{
						 unlink($currentPath);
					 }
					 unset($folderContents[$content]);
			}
			rmdir($folder);
	}
}

$test = '111';
	removeFolder("images/".$test);
 ?>

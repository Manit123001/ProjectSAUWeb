<?php
	function Insert($Table,$Field,$Value){
		$Insert=mysql_query("INSERT INTO $Table ($Field) VALUES ($Value)") or die (mysql_error());
		return $Insert;
	}

	function Select($Table,$Condition){
		$Select=mysql_query("SELECT * FROM $Table $Condition ") or die (mysql_error());
		return $Select;
	}

	function Delete($Table,$Condition){
		$Delete=mysql_query("DELETE FROM $Table $Condition ") or die (mysql_error());
		return $Delete;
	}

	function Update($Table,$Condition){
		$Updaate=mysql_query("UPDATE $Table SET $Condition") or die (mysql_error());
		return $Updaate;
	}

	//--------------- Function Num_Rows (WHERE) ---------------
	function Num_Rows($Condition){
		$Num_Rows=mysql_num_rows($Condition);
		return $Num_Rows;
	}


	//--------------- Function ResizePicture ---------------
	function ResizePicture($Picture_Tmp,$Rename,$Height,$Path){
		$Size=getimagesize($Picture_Tmp);
		$SizeX=$Size[0];
		$SizeY=$Size[1];
		$Weight=ceil($SizeX*$Height)/$SizeY;
		$Image_Fin=imagecreatetruecolor($Weight,$Height);

		$Image_Ori=imagecreatefrompng($Picture_Tmp);
		$ImageX=imagesx($Image_Ori);
		$ImageY=imagesy($Image_Ori);

		imagecopyresampled($Image_Fin,$Image_Ori,0,0,0,0,$Weight,$Height,$ImageX,$ImageY);
		imagepng($Image_Fin,$Path.$Rename);

		imagedestroy($Image_Fin);
		imagedestroy($Image_Ori);

		$Complate="Complate";
		return $Complate;
	}


			// removeFolder
			function removeFolder($folder){
				if(is_dir($folder) === true){
						$folderContents = scandir($folder);
						unset($folderContents[0], $folderContents[1]);

						foreach ($folderContents  as $content  => $contentName) {
								$currentPath = $folder.'/'.$contentName;
								 $filetpe = filetype($currentPath);
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


 ?>

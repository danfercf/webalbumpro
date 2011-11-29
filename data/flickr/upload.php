<?php
try 
{
	

	include_once 'conn.php';
	include_once 'phpFlickr.php';
	

	//*****************************
	// buscar el listado de fotos a subir
	//*****************************
	$query = "SELECT Fotos.id, Fotos.path, Eventos.idSet FROM Fotos
	INNER JOIN Eventos ON Fotos.idEvento = Eventos.id
	WHERE remoteId = 0";
	
	$fotos = mysql_query($query, $conexion) or die(mysql_error());
	$tot_deals = mysql_num_rows($fotos);
	
	//echo $query;
	
	
	if ($tot_deals> 0)
	{
		$phpFlickr = new phpFlickr('e59e909f1d76c528a40b27858b34edaf','c545dda8e7ae889e');
   			
   		$phpFlickr->setToken('72157626051223285-8c663d83e41133be');
   			
   		echo "Conexion a Flickr abierta<br/>";
   		flush_buffers();
   			
		while ($row_fotos = mysql_fetch_assoc($fotos))
		{
			
			$id = $row_fotos['id'];
			$path = $row_fotos['path'];
			$idSet = $row_fotos['idSet'];
	
			
			$new_photo_id = $phpFlickr->sync_upload($path,NULL, NULL, NULL,0);
			
			echo "La foto " . $id . " ha sido subida exitosamente con el siguiente id de Flickr = " . $new_photo_id . "<br/>";
			flush_buffers();
   			
        	$phpFlickr->photosets_addPhoto($idSet, $new_photo_id);
        	//$phpFlickr->photosets_removePhoto($model->idSet, '5489573709');
        	
        	echo "La foto " . $id . " ha sido asociada al set " . $idSet . " <br/>";
			flush_buffers();
			
			//echo $twitter_text;
			
			// actualizamos el deal
			mysql_query("UPDATE Fotos SET
				remoteId = '" . $new_photo_id . "'
				WHERE id = " . $id, 
			$conexion) or die(mysql_error());
			
			echo "La foto " . $id . " ha sido actualizada en la DB <br/>";
			flush_buffers();
			
			// borrar la foto local
			@unlink($path);
			echo "La foto " . $id . " se ha borrado del disco <br/>";
			
			
		}
	}
	else 
		die();
}

catch (Exception $e) 
{
		
	$to = "cesar@gulam.com.ar";
 	$subject = "Error en cron!";
 	//$body = $e->getMessage();
 	$body = "error";
 	mail($to, $subject, $body);
		
}


 
function flush_buffers(){ 
    ob_end_flush(); 
    ob_flush(); 
    flush(); 
    ob_start(); 
} 
 
?>
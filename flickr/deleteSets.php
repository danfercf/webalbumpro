<?php
try 
{
	

	include_once 'conn.php';
	include_once 'phpFlickr.php';
	

	$phpFlickr = new phpFlickr('e59e909f1d76c528a40b27858b34edaf','c545dda8e7ae889e');
   			
   	$phpFlickr->setToken('72157626051223285-8c663d83e41133be');
   	
   	echo "Conexion a Flickr abierta<br/>";
   	flush();
   		
	//*****************************
	// buscar el listado de sets
	//*****************************
		
	$photosets = $phpFlickr->photosets_getList();
	echo "Bucamos el listado de Sets<br/>";
   	flush();
	
	foreach ($photosets['photoset'] as $set)
	{
		$phpFlickr->photosets_delete($set['id']);
		echo "El set " . $set['id'] . " ha sido eliminado<br/>";
   		flush();
	}
	
}

catch (Exception $e) 
{
		
	$to = "cesar@gulam.com.ar";
 	$subject = "Error en cron!";
 	//$body = $e->getMessage();
 	$body = "error";
 	mail($to, $subject, $body);
		
}

?>
<?php
/**
 * Image helper functions
 * 
 * @author Chris
 * @link http://con.cept.me
 */
class ImageHelper {

    /**
     * Directory to store thumbnails
     * @var string 
     */
    const THUMB_DIR = 'tmb';

    /**
     * Create a thumbnail of an image and returns relative path in webroot
     * the options array is an associative array which can take the values
     * quality (jpg quality) and method (the method for resizing)
     *
     * @param int $width
     * @param int $height
     * @param string $img
     * @param array $options
     * @return string $path
     */
    public static function thumb($width, $height, $img, $options = null,$dir,$method,$watermark)
    {
        if(!file_exists($img)){
            $img = str_replace('\\', '/', YiiBase::getPathOfAlias('webroot').$img);
            if(!file_exists($img)){
                throw new CException('Image not found');
            }
        }

        // Jpeg quality
        $quality = 100;
        // Method for resizing
        //$method = 'adaptiveResize';

        if($options){
            extract($options, EXTR_IF_EXISTS);
        }

        $pathinfo = pathinfo($img);
        $thumb_name = $pathinfo['filename'].'.'.$pathinfo['extension'];
        $thumb_path = $pathinfo['dirname'].'/'.$dir.'/';
        if(!file_exists($thumb_path)){
            mkdir($thumb_path);
        }
        
        if(!file_exists($thumb_path.$thumb_name) || filemtime($thumb_path.$thumb_name) < filemtime($img)){
            
            Yii::import('ext.phpThumb.PhpThumbFactory');
            $options = array('jpegQuality' => $quality);
            $thumb = PhpThumbFactory::create($img, $options);
            $thumb->{$method}($width, $height);
            $thumb->save($thumb_path.$thumb_name);
            
            if ($watermark)
            {
            	// Create image instances
				$dest = imagecreatefromjpeg($thumb_path.$thumb_name);
				$src = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .'images/logo.png');
				
				$watermark_width = imagesx($src);   
				$watermark_height = imagesy($src);
				
				 $image = getimagesize($thumb_path.$thumb_name);

	       		 $dest_x = $image[0] - $watermark_width - 5;   
				$dest_y = $image[1] - $watermark_height - 5;
				
				echo $dest_x . " - " . $dest_y; 
				
				// Copy and merge
				//imagecopymerge($dest, $src, $width-100, $height-100, 0, 0, 360, 70, 50);
				imagecopymerge($dest, $src, $dest_x,$dest_y,0, 0, $watermark_width, $watermark_height, 50);
				
				// Output and free from memory
				//header('Content-Type: image/gif');
				imagejpeg($dest,$thumb_path.$thumb_name);
				
				imagedestroy($dest);
				imagedestroy($src);
            }
        }
        
        $relative_path = str_replace(YiiBase::getPathOfAlias('webroot'), '', $thumb_path.$thumb_name);
        return $relative_path;
    }
}
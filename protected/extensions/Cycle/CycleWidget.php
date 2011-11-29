<?php
/**
 * Copyright (c) 2010, Gareth Bond, http://www.gazbond.co.uk
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided
 * that the following conditions are met:
 *
 *   * Redistributions of source code must retain the above copyright notice, this list of conditions and the
 *     following disclaimer.
 *   * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and
 *     the following disclaimer in the documentation and/or other materials provided with the distribution.
 *   * Neither the name of Yii Software LLC nor the names of its contributors may be used to endorse or
 *     promote products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A
 * PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
 * HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF
 * THE POSSIBILITY OF SUCH DAMAGE.
 */


class CycleWidget extends CWidget {
	
	const ASSETS_DIR_NAME       = 'assets';
    const JQUERYCYCLE_FILE_NAME = 'jquery.cycle.min.js';
    
    public $config = array();
    public $images = array();
    
    public function init() {        
    	
    	$localPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . self::ASSETS_DIR_NAME;
    	$publicPath = Yii::app()->getAssetManager()->publish($localPath);
    	
    	
    	$jQueryCyclePath = $publicPath . DIRECTORY_SEPARATOR . self::JQUERYCYCLE_FILE_NAME;
    	
        Yii::app()->clientScript->registerScriptFile($jQueryCyclePath);
        
       

        $jsConfig = json_encode($this->config);
        $jqueryScript = "jQuery('#$this->id').cycle({$jsConfig});";
        $uniqueId = 'Yii.' . __CLASS__ . '#' . $this->id;
        Yii::app()->clientScript->registerScript($uniqueId, stripcslashes($jqueryScript), CClientScript::POS_READY);
    }

    public function run()
    {
        echo "<div id=\"$this->id\">";
        foreach ($this->images as $image)
        {
        	echo "<img src='" . $image . "'>";
        }
		echo "</div>";
    }
}
?>

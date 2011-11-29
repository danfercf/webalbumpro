<div id="photo">
			<div class="image">
				<img src="" id="main_photo" border="0">
			</div>
			<div id="photo_actions">
				<div class="actions">
					Ver:<br/>
					<div class="image_actions"><a id="main_photo_l" href="">Grande</a> | <a id="main_photo_o" href="">Original</a><br/><br/></div>
					Compartir:<br/>
					<iframe id="share_facebook" src="http://www.facebook.com/plugins/like.php?href=webalbumpro.com&amp;layout=button_count&amp;show_faces=false&amp;width=90&amp;action=like&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" ></iframe><a id="share_twitter" href='http://twitter.com/home?status=Vean esta foto en Web Album Pro' target='blank'><img border="0" src="/images/icon_twitter.png"></a> <img src="/images/icon_mail.png"><br/>
					Titulo:<br/>
					xxxx<br/>
					Eliminar<br/>
				</div>
			</div>
			
		</div>
		<script type="text/javascript">
$(document).ready(function()
{
	$('#photo').mouseenter(function() 
		{
	  		$('#photo_actions').slideDown('fast', function(){
	   		 // 	Animation complete.
	  		 });
	  	});
	
	$('#photo').mouseleave(function() {
		  $('#photo_actions').slideToggle('fast', function() {
		    // Animation complete.
		  });
	});
})
</script>
<?php 
// import the extension
Yii::import('ext.jqPrettyPhoto');
 
$options = array(
    'slideshow'=>5000,
    'autoplay_slideshow'=>false, 
    'show_title'=>false
);
// call addPretty static function
jqPrettyPhoto::addPretty('.image a',jqPrettyPhoto::PRETTY_SINGLE,jqPrettyPhoto::THEME_FACEBOOK, $options);
jqPrettyPhoto::addPretty('.image_actions a',jqPrettyPhoto::PRETTY_SINGLE,jqPrettyPhoto::THEME_FACEBOOK, $options);

 //$this->renderPartial('/fotos/share', array('id'=>$model->id));
?>
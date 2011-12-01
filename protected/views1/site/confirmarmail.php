<style type="text/css">
<!--
	.mensaje {
     margin: 50px 205px 0 !important;
     width: 520px !important;
    }
-->
</style>
<?php
$this->layout='public';

$this->pageTitle=Yii::app()->name . ' - Confirmar correo';

?>

<div class="tpl-2col">
	<?php
            if ($model->mensaje != '')
			{
				echo "<div class='mensaje'>" . $model->mensaje . "</div>";
			}else{
    ?>
    <div class="confirmar_correo">    
        <h1><strong>Confirmar correo</strong></h1>

		<h3>Usted debe confirmar su direcci&oacute;n de correo</h3>
		<p>Se envi&oacute; un correo electr&oacute;nico al email que usted registr&oacute;</p>
    <?php }?>
	</div>
</div>


<h1>Импорт</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl('/Import/adminstep2'),
	'enableAjaxValidation'=>false
)); ?>	
	<a href="#" data-path="<? echo Yii::app()->createUrl('/uploader/getForm',array('maxFiles'=>1,'extensions'=>'*', 'title' => 'Загрузка файла "Excel"', 'selector' => '.b-excel-input') ); ?>" class="b-get-image" >Загрузить файл</a>
	<input type="hidden" name="excel_name" class="b-excel-input">
	<input type="submit" value="Далее">
<?php $this->endWidget(); ?>



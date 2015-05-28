<h1>Импорт</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl('/import/adminstep2'),
	'enableAjaxValidation'=>false,
	'id'=>'b-import-form'
)); ?>	
	<a href="#" data-path="<? echo Yii::app()->createUrl('/uploader/getForm',array('maxFiles'=>1,'extensions'=>'xls,xlsx', 'title' => 'Загрузка файла "Excel"', 'selector' => '.b-excel-input') ); ?>" class="b-get-image b-get-xls" ><img class="b-import-image" src="/images/excel.png" alt=""><span>Загрузить файл</span></a>
	<input type="hidden" name="excel_name" class="b-excel-input">
	<div>
		<a type="submit" href="#" id="b-next" onclick="$('#b-import-form').submit();" class="hidden b-import-butt b-butt">Импортировать</a>
	</div>
<?php $this->endWidget(); ?>



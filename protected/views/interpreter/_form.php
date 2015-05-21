<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'faculties-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>255,'required'=>true)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'good_type_id'); ?>
		<?php echo $form->dropDownList($model, 'good_type_id', CHtml::listData(GoodType::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'good_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'template'); ?>
		<?php echo $form->textArea($model,'template',array('maxlength'=>2000,'required'=>true,'style'=>'height: 300px;')); ?>
		<?php echo $form->error($model,'template'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
		<input type="button" onclick="$.fancybox.close(); return false;" value="Отменить">
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
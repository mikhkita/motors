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

	<div class="row b-car-image">
		<?php echo $form->labelEx($model,'car'); ?>
		<div class="b-image-cancel">Отменить удаление</div>
		<div class="b-image-cont">
			<div data-path="<? echo Yii::app()->createUrl('/uploader/getForm',array('maxFiles'=>1,'extensions'=>'*', 'title' => 'Загрузка изображения автомобиля', 'selector' => '.b-car-image .b-input-image', 'tmpPath' => Yii::app()->params['tempFolder']) ); ?>" class="b-input-image-add b-get-image<? if( $model->car != "" ) echo " hidden"; ?>" title="Добавить изображение"></div>
			<div class="b-image-wrap<? if( $model->car == "" ) echo " hidden"; ?>">
				<div class="b-input-image-img" data-base="<? echo Yii::app()->request->baseUrl; ?>" style="background-image: url('<? echo (Yii::app()->request->baseUrl)."/".($model->car); ?>');"></div>
				<?php echo $form->textField($model,'car',array('class'=>'b-input-image')); ?>
				<?php echo $form->error($model,'car'); ?>
				<div class="b-image-controls clearfix">
					<div class="b-image-nav b-image-edit b-get-image" title="Изменить изображение"></div>
					<div class="b-image-nav b-image-delete" title="Удалить изображение"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row b-logo-image">
		<?php echo $form->labelEx($model,'logo'); ?>
		<div class="b-image-cancel">Отменить удаление</div>
		<div class="b-image-cont">
			<div data-path="<? echo Yii::app()->createUrl('/uploader/getForm',array('maxFiles'=>1,'extensions'=>'*', 'title' => 'Загрузка изображения логотипа', 'selector' => '.b-logo-image .b-input-image', 'tmpPath' => Yii::app()->params['tempFolder']) ); ?>" class="b-input-image-add b-get-image<? if( $model->logo != "" ) echo " hidden"; ?>" title="Добавить изображение"></div>
			<div class="b-image-wrap<? if( $model->logo == "" ) echo " hidden"; ?>">
				<div class="b-input-image-img" data-base="<? echo (Yii::app()->request->baseUrl); ?>" style="background-image: url('<? echo (Yii::app()->request->baseUrl)."/".($model->logo); ?>');"></div>
				<?php echo $form->textField($model,'logo',array('class'=>'b-input-image')); ?>
				<?php echo $form->error($model,'logo'); ?>
				<div class="b-image-controls clearfix">
					<div class="b-image-nav b-image-edit b-get-image" title="Изменить изображение"></div>
					<div class="b-image-nav b-image-delete" title="Удалить изображение"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
		<input type="button" onclick="$.fancybox.close(); return false;" value="Отменить">
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<h1>Иморт - шаг 2</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'import-step2',
	'action' => Yii::app()->createUrl('/Import/adminstep3'),
	'enableAjaxValidation'=>false
)); ?>


	<table class="b-table b-import-preview-table" border="1">
        <? foreach ($arr as $mark_name => $mark): ?>
            <tr> 
                <td>
                    <!-- <input type="hidden" name="mark[]" value="<?=$mark_name?>">  -->          
                    <? foreach ($mark as $model_name => $model): ?>
                        <? foreach ($model as $i => $engine): ?>
                            <input type="hidden" name="<?=$mark_name?>['<?=$model_name?>'][]" value="<?=$engine['name']?>|<?=$engine['hp']?>">
                        <? endforeach ?> 
                    <? endforeach ?>   
                </td> 
            </tr>
        <? endforeach ?>
    </table>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Перейти к предпросмотру'); ?>
		<input type="hidden" name="excel_path" value="<?=$excel_path?>">
		<input type="button" value="Отменить">
	</div>

<?php $this->endWidget(); ?>
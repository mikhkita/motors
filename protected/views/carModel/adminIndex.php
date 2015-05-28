<? if( $error != NULL ) echo "<script>alert('".$error."');</script>"; ?>
<h1><?=$mark_name?></h1>
<a href="<?php echo $this->createUrl('/mark/adminindex')?>" class="b-link-back">Назад</a>
<a href="<?php echo $this->createUrl('/'.$this->adminMenu["cur"]->code.'/admincreate')?>" class="ajax-form ajax-create b-butt b-top-butt">Добавить</a>
<?php $form=$this->beginWidget('CActiveForm'); ?>
	<table class="b-table" border="1">
		<tr>
			<? if( $this->getUserRole() == "root" ):  ?>
				<th style="width: 30px;"><? echo $labels['id']; ?></th>
			<? endif; ?>
			<th><? echo $labels['name']; ?></th>
			<th style="width: 150px;">Действия</th>
		</tr>
		<tr class="b-filter">
			<? if( $this->getUserRole() == "root" ):  ?>
				<td></td>
			<? endif; ?>
			<td><?php echo $form->hiddenField($filter, 'mark_id'); ?><?php echo CHtml::activeTextField($filter, 'name'); ?></td>
			<td><a href="#" class="b-clear-filter">Сбросить фильтр</a></td>
		</tr>
		<? if( count($data) ): ?>
			<? foreach ($data as $i => $item): ?>
				<tr>
					<? if( $this->getUserRole() == "root" ):  ?>
						<td><?=$item->id?></td>
					<? endif; ?>
					<td class="align-left"><a href="<?php echo $this->createUrl('/engine/adminindex',array('model_id'=>$item->id,'mark_id'=>$_GET["mark_id"]))?>"><?=$item->name?></a></td>
					<td class="b-tool-cont">
						<a href="<?php echo Yii::app()->createUrl('/'.$this->adminMenu["cur"]->code.'/adminupdate',array('id'=>$item->id))?>" class="ajax-form ajax-update b-tool b-tool-update" title="Редактировать <?=$this->adminMenu["cur"]->vin_name?>"></a>
						<a href="<?php echo Yii::app()->createUrl('/'.$this->adminMenu["cur"]->code.'/admindelete',array('id'=>$item->id))?>" class="ajax-form ajax-delete b-tool b-tool-delete" title="Удалить <?=$this->adminMenu["cur"]->vin_name?>"></a>
					</td>
				</tr>
			<? endforeach; ?>
		<? else: ?>
			<tr>
				<td colspan=10>Пусто</td>
			</tr>
		<? endif; ?>
	</table>
<?php $this->endWidget(); ?>
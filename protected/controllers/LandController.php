<?php

class LandController extends Controller
{
	public $layout='//layouts/land';

	public function filters()
	{
		return array(
				'accessControl'
			);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('Index'),
				'roles'=>array('manager'),
			),
			array('allow',
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex($partial = false,$mark = false)
	{
		if($mark!=false && $mark!="") {
			$model = Mark::model()->findByAttributes(array('name'=>$mark));
		}
		if($model=="" || !isset($model)) {
			$model = Mark::model()->findByAttributes(array('name'=>'Автомобиль'));		
		}
		$images = array("name" => $model->name,"car" => $model->car,"logo" => $model->logo);
		$model = Mark::model()->with('models','models.engines')->findAll();
		$this->render('Index',array(
			'model' => $model,
			'images' => $images
		));
	}
			
	public function loadModel($id)
	{
		$model=Good::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
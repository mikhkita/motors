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

	public function actionIndex($partial = false)
	{	
		$images = array("name" => "автомобиль","car" => Yii::app()->request->baseUrl."/upload/images/default.png","logo" => "");
		if(isset($_SERVER['HTTP_REFERER'])) {
			$model = Mark::model()->findAll();
			foreach ($model as $key => $value) {
				$mark = explode(" ", $value->name);
				$last_word = array_pop($mark);
				$pos = strripos($_SERVER['HTTP_REFERER'], $last_word);
				if($pos) {
					$model = Mark::model()->findbyPk($value->id);
					if($model->car!='') $model->car = Yii::app()->request->baseUrl."/".$model->car;
					if($model->logo!='') $model->logo = Yii::app()->request->baseUrl."/".$model->logo;
					$images = array("name" => $model->name,"car" => $model->car,"logo" => $model->logo);
					break;
				}			
			}
		}
		;
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

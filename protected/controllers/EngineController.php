<?php

class EngineController extends Controller
{
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
				'actions'=>array('adminIndex','adminCreate','adminUpdate','adminDelete'),
				'roles'=>array('manager'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdminCreate($modelId)
	{
		$model=new Engine;

		if(isset($_POST['Engine']))
		{
			$_POST['Engine'] = $this->clean_post($_POST['Engine']);
			$_POST['Engine']['model_id'] = $modelId;
			$model->attributes=$_POST['Engine'];
			if($model->save()){
				$this->actionAdminIndex(true,$modelId);
				return true;
			}
		}

		$this->renderPartial('adminCreate',array(
			'model'=>$model,
		));

	}

	public function actionAdminUpdate($id,$modelId)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Engine']))
		{
			$_POST['Engine'] = $this->clean_post($_POST['Engine']);
			$model->attributes=$_POST['Engine'];
			if($model->save())
				$this->actionAdminIndex(true,$modelId);
		}else{
			$this->renderPartial('adminUpdate',array(
				'model'=>$model,
			));
		}
	}

	public function actionAdminDelete($id,$modelId)
	{
		$this->loadModel($id)->delete();

		$this->actionAdminIndex(true,$modelId);
	}

	public function actionAdminIndex($partial = false,$modelId = false)
	{
		if( !$partial ){
			$this->layout='admin';
		}
		$filter = new Engine('filter');
		$criteria = new CDbCriteria();

		if (isset($_GET['Engine']))
        {
            $filter->attributes = $_GET['Engine'];
            foreach ($_GET['Engine'] AS $key => $val)
            {
                if ($val != '')
                {
                    if( $key == "name" ){
                    	$criteria->addSearchCondition('name', $val);
                    }else{
                    	$criteria->addCondition("$key = '{$val}'");
                    }
                }
            }
        }

        $criteria->order = 'id DESC';

        if( $modelId ){
			$model = CarModel::model()->with('engines')->findByPk($modelId);
			
			if( !$partial ){
				$this->render('adminIndex',array(
					'data'=>$model->engines,
					'modelId' => $modelId,
					'modelName' => $model->name,
					'filter'=>$filter,
					'labels'=>Engine::attributeLabels()
				));
			}else{
				$this->renderPartial('adminIndex',array(
					'data'=>$model->engines,
					'modelId' => $modelId,
					'modelName' => $model->name,
					'filter'=>$filter,
					'labels'=>Engine::attributeLabels()
				));
			}
		}
	}
	public function clean_post($array) {
		foreach ($array as $key => &$value) {
			$value = stripslashes($value);
		    $value = html_entity_decode($value);
		    $value = strip_tags($value);
		    $value = trim($value);
		}
		return $array;
	} 
	public function loadModel($id)
	{
		$model=Engine::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}

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

	public function actionAdminCreate()
	{
		$model=new Engine;

		if(isset($_POST['Engine']))
		{
			foreach ($_POST['Engine'] as &$value) {
		    	$value = trim($value);
			}
			$engine = Engine::model()->findByAttributes(array("name" =>$_POST['Engine']['name']));
			if($engine=="") {	
				$_POST['Engine']['model_id'] = $_GET['Engine']['model_id'];
				$model->attributes=$_POST['Engine'];
				if($model->save()){
					$this->actionAdminIndex(true);
					return true;
				}
			} else {
				$this->actionAdminIndex(true,"Такое имя уже существует");
				return true;
			}
		}

		$this->renderPartial('adminCreate',array(
			'model'=>$model,
		));

	}

	public function actionAdminUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Engine']))
		{
			foreach ($_POST['Engine'] as &$value) {
		    	$value = trim($value);
			}
			$engine = Engine::model()->findByAttributes(array("name" =>$_POST['Engine']['name']));
			if($engine=="" || $_POST['Engine']['name']==$model->name) {	
				$model->attributes=$_POST['Engine'];
				if($model->save())
					$this->actionAdminIndex(true);
			} else {
				$this->actionAdminIndex(true,"Такое имя уже существует");
			}
		}else{
			$this->renderPartial('adminUpdate',array(
				'model'=>$model,
			));
		}
	}

	public function actionAdminDelete($id)
	{
		$this->loadModel($id)->delete();

		$this->actionAdminIndex(true);
	}

	public function actionAdminIndex($partial = false, $error = NULL)
	{
		if (!isset($_GET['Engine'])) {
			$_GET['Engine']["model_id"] = $_GET["model_id"];
		}
		
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

        $criteria->order = 'name ASC';
  
		$model = Engine::model()->findAll($criteria);
		$car_model = CarModel::model()->findByPk($_GET['Engine']['model_id']);
		$option = array(
			'data'=>$model,
			'modelName' => $car_model->name,
			'filter'=>$filter,
			'error' =>$error,
			'labels'=>Engine::attributeLabels()
		);
		if( !$partial ){
			$this->render('adminIndex',$option);
		}else{
			$this->renderPartial('adminIndex',$option);
		}
	}
	public function loadModel($id)
	{
		$model=Engine::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}

<?php

class CarModelController extends Controller
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
		$model=new CarModel;

		if(isset($_POST['CarModel']))
		{
			foreach ($_POST['CarModel'] as &$value) {
		    	$value = trim($value);
			}
			$car_model = CarModel::model()->findByAttributes(array("name" =>$_POST['CarModel']['name']));
			if($car_model=="") {	
				$model->attributes = $_POST['CarModel'];
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

		if(isset($_POST['CarModel']))
		{
			foreach ($_POST['CarModel'] as &$value) {
		    	$value = trim($value);
			}
			$car_model = CarModel::model()->findByAttributes(array("name" =>$_POST['CarModel']['name']));
			if($car_model=="" || $_POST['CarModel']['name']==$model->name) {
				$model->attributes=$_POST['CarModel'];
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
		if( !$partial ){
			$this->layout='admin';
		}
		$filter = new CarModel('filter');
		$criteria = new CDbCriteria();

		if (isset($_GET['CarModel']))
        {
            $filter->attributes = $_GET['CarModel'];
            foreach ($_GET['CarModel'] AS $key => $val)
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
		$model = CarModel::model()->findAll($criteria);
		$mark = Mark::model()->findByPk($_GET['CarModel']['mark_id']);
		$option = array(
			'data'=>$model,
			'mark_name' => $mark->name,
			'filter'=>$filter,
			'error' =>$error,
			'labels'=>CarModel::attributeLabels()
		);
		if( !$partial ){
			$this->render('adminIndex',$option);
		}else{
			$this->renderPartial('adminIndex',$option);
		}

	}

	public function loadModel($id)
	{
		$model=CarModel::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}

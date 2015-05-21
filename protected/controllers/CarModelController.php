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

	public function actionAdminCreate($markId)
	{
		$model=new CarModel;

		if(isset($_POST['CarModel']))
		{
			$_POST['CarModel']['mark_id'] = $markId;
			$model->attributes = $_POST['CarModel'];
			if($model->save()){
				$this->actionAdminIndex(true,$markId);
				return true;
			}
		}

		$this->renderPartial('adminCreate',array(
			'model'=>$model,
		));

	}

	public function actionAdminUpdate($id,$markId)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['CarModel']))
		{
			$model->attributes=$_POST['CarModel'];
			if($model->save())
				$this->actionAdminIndex(true,$markId);
		}else{
			$this->renderPartial('adminUpdate',array(
				'model'=>$model,
			));
		}
	}

	public function actionAdminDelete($id,$markId)
	{
		$this->loadModel($id)->delete();

		$this->actionAdminIndex(true,$markId);
	}

	public function actionAdminIndex($partial = false,$markId = false)
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

        $criteria->order = 'id DESC';

			$model = Mark::model()->with('models')->findByPk($criteria);
		
			if( !$partial ){
				$this->render('adminIndex',array(
					'data'=>$model->models,
					'markId' => $markId,
					'markName' => $model->name,
					'filter'=>$filter,
					'labels'=>CarModel::attributeLabels()
				));
			}else{
				$this->renderPartial('adminIndex',array(
					'data'=>$model->models,
					'markId' => $markId,
					'markName' => $model->name,
					'filter'=>$filter,
					'labels'=>CarModel::attributeLabels()
				));
			}
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

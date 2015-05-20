<?php

class MarkController extends Controller
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
				'actions'=>array('adminIndex','adminCreate','adminUpdate','adminDelete','adminAdd'),
				'roles'=>array('manager'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdminCreate()
	{
		$model=new Mark;

		if(isset($_POST['Mark']))
		{
			if($_POST['Mark']['car']!="") {
				$temp_car = Yii::app()->params['tempFolder']."/".$_POST['Mark']['car'];
				$_POST['Mark']['car'] = Yii::app()->params['imageFolder']."/".$_POST['Mark']['car'];
				rename($temp_car,$_POST['Mark']['car']);
			}
			if($_POST['Mark']['logo']!="") {
				$temp_logo = Yii::app()->params['tempFolder']."/".$_POST['Mark']['logo'];
				$_POST['Mark']['logo'] = Yii::app()->params['imageFolder']."/".$_POST['Mark']['logo'];
				rename($temp_logo,$_POST['Mark']['logo']);
			}
			$model->attributes=$_POST['Mark'];
			if($model->save()){
				$this->actionAdminIndex(true);
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

		if(isset($_POST['Mark']))
		{
			if($_POST['Mark']['car']!="" && $_POST['Mark']['car']!=$model->car) {
				$temp_car = Yii::app()->params['tempFolder']."/".$_POST['Mark']['car'];
				$_POST['Mark']['car'] = Yii::app()->params['imageFolder']."/".$_POST['Mark']['car'];
				rename($temp_car,$_POST['Mark']['car']);
			}
			if($_POST['Mark']['logo']!="" && $_POST['Mark']['logo']!=$model->logo) {
				$temp_logo = Yii::app()->params['tempFolder']."/".$_POST['Mark']['logo'];
				$_POST['Mark']['logo'] = Yii::app()->params['imageFolder']."/".$_POST['Mark']['logo'];
				rename($temp_logo,$_POST['Mark']['logo']);
			}
			$model->attributes=$_POST['Mark'];
			if($model->save())
				$this->actionAdminIndex(true);
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

	public function actionAdminIndex($partial = false)
	{
		if( !$partial ){
			$this->layout='admin';
		}
		$filter = new Mark('filter');
		$criteria = new CDbCriteria();

		if (isset($_GET['Mark']))
        {
            $filter->attributes = $_GET['Mark'];
            foreach ($_GET['Mark'] AS $key => $val)
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
        

        $model = Mark::model()->findAll($criteria);

		if( !$partial ){
			$this->render('adminIndex',array(
				'data'=>$model,
				'filter'=>$filter,
				'labels'=>Mark::attributeLabels()
			));
		}else{
			$this->renderPartial('adminIndex',array(
				'data'=>$model,
				'filter'=>$filter,
				'labels'=>Mark::attributeLabels()
			));
		}

	}

	public function loadModel($id)
	{
		$model=Mark::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionAdminAdd() {
		$xls = $this->getXLS(Yii::app()->basePath.'/Katalog.xls');
		$arr= array();
		$Cars = array("Ford","Chevrolet");
		for ($i=1; $i < count($xls); $i++) { 
			for ($j=0; $j < count($Cars); $j++) { 
				if($xls[$i][1]==$Cars[$j]) {
					if(!isset($arr[$Cars[$j]])) $arr[$Cars[$j]] = array();
					if(!isset($arr[$Cars[$j]][$xls[$i][2]])) $arr[$Cars[$j]][$xls[$i][2]] = array();
					$engine = array();
					$str_to_del = array($xls[$i][1],$xls[$i][2]);
					$engine['name'] = trim(str_ireplace($str_to_del,"", $xls[$i][3]));
					$engine['hp'] = $xls[$i][4];
					array_push($arr[$Cars[$j]][$xls[$i][2]], $engine);
				}
			}
			
		}
		foreach ($arr as $mark => $mark_value) {
			$model=new Mark;
			$model->attributes=array("name" => $mark);
			$model->save();
			$mark_id = $model->id;
			foreach ($mark_value as $car_model => $car_model_value) {
				$model=new CarModel;
				$model->attributes=array("name" => $car_model,'mark_id' => $mark_id);
				$model->save();
				$car_model_id = $model->id;
				foreach ($car_model_value as $i => $engine) {
					$model=new Engine;
					$model->attributes=array("name" => $engine['name'],"horsepower" => $engine['hp'],'model_id' => $car_model_id);
					$model->save();
				}

			}
		}
	}
	private	function getXLS($xls,$rows = false,$titles = false){
		if( is_array($rows) && $titles === false )
			throw new CHttpException(404,'Отсутствуют наименования столбцов');

		include_once  Yii::app()->basePath.'/phpexcel/Classes/PHPExcel.php';
		include_once  Yii::app()->basePath.'/phpexcel/Classes/PHPExcel/IOFactory.php';
		
		$objPHPExcel = PHPExcel_IOFactory::load($xls);
		$objPHPExcel->setActiveSheetIndex(0);
		$aSheet = $objPHPExcel->getActiveSheet();
		
		$array = array();
		$cols = 1;

		for ($i = 1; $i <= $aSheet->getHighestRow(); $i++) {  
		    $item = array();
		    for ($j = 0; $j < $cols; $j++) {
		        $val = $aSheet->getCellByColumnAndRow($j, $i)->getCalculatedValue()."";

	        	// Этот кусок кода ограничивает матрицу по столбцам смотря на первую строку.
				// Если в первой строке 3 ячейки заполенных, 
				// то и во всех остальных он будет смотреть только по первым трем ячейкам.
		        if( !($val === "" && $i == 1) && $j < $cols ){
					array_push($item, ($val === "")?NULL:trim($val) );
					if( $i == 1 ) $cols++;
				}
		    }

		    // Если мы в переменной передаем массив отсортированных наименований столбцов
			// то происходит сортировка столбцов по этому массиву
			if(is_array($rows)) {
				$tmp = array();
				foreach ($rows as $key => $value) {
					if($value!="no-id") {
						if( $i == 1 ){
							array_push($tmp,$titles[intval($value)]["NAME"]);
						}else{
							array_push($tmp,$item[$key]);
						}
					}
				}
				$item=$tmp;
			}

			// Если нам нужна только первая строка
			if($rows === 1) return $item;

			array_push($array, $item);
		}
		return $array;
	} 
}

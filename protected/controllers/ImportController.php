<?php

class ImportController extends Controller
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
				'actions'=>array('adminIndex','adminStep2','adminStep3'),
				'roles'=>array('manager'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionAdminIndex($partial = false)
	{
		// $this->scripts[] = "import";
		$this->render('adminIndex',array(
			// 'model'=>$model
		));

	}
	

	public function actionAdminStep2($partial = false)
	{

		if(isset($_POST["excel_name"])) {

			$excel_path = Yii::app()->params['tempFolder']."/".$_POST["excel_name"];

			$xls = $this->getXLS($excel_path);

			$arr= array();
			for ($i=1; $i < count($xls); $i++) { 
				if(!isset($arr[$xls[$i][1]])) $arr[$xls[$i][1]] = array();
				if(!isset($arr[$xls[$i][1]][$xls[$i][2]])) $arr[$xls[$i][1]][$xls[$i][2]] = array();
				$engine = array();
				$str_to_del = array($xls[$i][1],$xls[$i][2]);
				$engine['name'] = trim(str_ireplace($str_to_del,"", $xls[$i][3]));
				$engine['hp'] = $xls[$i][4];
				array_push($arr[$xls[$i][1]][$xls[$i][2]], $engine);				
			}
			// print_r($arr);
			$this->render('adminStep2',array(
				'arr'=>$arr,
				'excel_path'=>$excel_path
				
			));
		}
	}
	public function actionAdminStep3($partial = false)
	{
		print_r($_POST);
	}
	
	public function loadModel($id)
	{
		$model=Import::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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

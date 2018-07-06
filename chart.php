<?php
require_once (__DIR__."/vendor/autoload.php");
use Sunra\PhpSimple\HtmlDomParser;
$filename = $_POST['namefile'];
if ($filename=='Не выбрано'){header('Location: ./?graph=no');}
else{
	$str = file_get_contents(__DIR__."/upload/".$filename);
	$html = new HtmlDomParser();
	$el = $html->str_get_html($str);
	//$el = $html->file_get_html('test.html');
	$s = $el->find("tr");
	$i = 0;
	foreach ($s as $value) {
		//echo $value ."</br>";
		//echo"-----------------------------------------------------</br>";
		$sq = $html->str_get_html($value);
		$q = $sq->find("td");
		foreach ($q as $val) {
			//echo count($val) ."</br>";
			//echo $val->plaintext."</br>";
			//$tr = $html->str_get_html($val);
			//$td = $tr->find('td');
			$arr[$i][] = $val->plaintext;
		}
		$i++;
		//echo "-----------------------------------------------------</br>";
	}
	//var_dump($arr);
		$balance = (float) 0; //результирующий баланс
		$type = ''; //тип операции
		foreach($arr as $val){
			$type = $val[2];

			if ($type == 'balance'){
				if(strripos($val[3],'ransfer from')){//зачислили на баланс
					$var = str_replace(" ","",$val[4]);
					$balance = $balance + (float) $var;
				}elseif(strripos($val[3],'ransfer to')){//списали с баланса
					$var = str_replace(" ","",$val[4]);
					$balance = $balance + (float) ($var);
				}elseif(strripos($val[3],'withdraw skrill')){//списали с баланса
					$var = str_replace(" ","",$val[4]);
					$balance = $balance + (float) ($var);
				}elseif(strripos($val[3],'withdraw canceled')){//зачислили на баланс
					$var = str_replace(" ","",$val[4]);
					$balance = $balance + (float) $var;
				}
				$res[] = $balance;
			}
			elseif ($type == 'buy'){
				$balance = $balance + ((float) $val[13]) - (float) abs($val[10]);
				$res[] = $balance;
			}
		}
		if (count($res) != 0){
			//$res = json_encode($res);
			$res_str = "\"[['X','Баланс'],";//Начало строки для графика
			
			foreach ($res as $key=>$value) {
				//echo "['".$key."',".$value."],</br>";
				$res_str .= "['".$key."',".$value."],";
			}
			$res_str .= "]\"";//конец строки для графика
			header('Location: ./?graph=yes&resstr='.$res_str);//на главную
		}else{
			$res_str ="";
			header('Location: ./?graph=yes&resstr='.$res_str);//на главную
		}
	}
?>
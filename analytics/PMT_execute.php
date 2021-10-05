<?php

$message = $_GET["message"];

if($message == "train")
{
	$dataset_name = $_GET["dataset_name"];
	$algorithm_number = $_GET["algorithm_number"];
	system("python3 PMT_model_train.py ".$dataset_name." ".$algorithm_number." 2&>1");
}
if($message == "save")
{
	$dataset_name = $_GET["dataset_name"];
	$algorithm_number = $_GET["algorithm_number"];
	$model_name = $_GET["model_name"];
	system("python3 PMT_model_train_and_save.py ".$dataset_name." ".$algorithm_number." ".$model_name." 2&>1");
}
if($message == "predict")
{
	$model_name = $_GET["model_name"];
	$hacdor = $_GET["hacdor"];
	$rooms = $_GET["rooms"];
	$v18q = $_GET["v18q"];
	$r4h1 = $_GET["r4h1"];
	$r4m1 = $_GET["r4m1"];
	$r4t1 = $_GET["r4t1"];
	$escolari = $_GET["escolari"];
	$paredblolad = $_GET["paredblolad"];
	$paredmad = $_GET["paredmad"];
	$pisomoscer = $_GET["pisomoscer"];
	$cielorazo = $_GET["cielorazo"];
	$energcocinar2 = $_GET["energcocinar2"];
	$energcocinar4 = $_GET["energcocinar4"];
	$elimbasu1 = $_GET["elimbasu1"];
	$hogar_nin = $_GET["hogar_nin"];
	$dependency = $_GET["dependency"];
	$edjefe = $_GET["edjefe"];
	$meaneduc = $_GET["meaneduc"];
	$overcrowding = $_GET["overcrowding"];
	$computer = $_GET["computer"];
	$qmobilephone = $_GET["qmobilephone"];
	$lugar1 = $_GET["lugar1"];
	$wall_condition = $_GET["wall_condition"];
	$roof_condition = $_GET["roof_condition"];
	$floor_condition = $_GET["floor_condition"];
	
	$inputs = $hacdor.",".$rooms.",".$v18q.",".$r4h1.",".$r4m1.",".$r4t1.","
	.$escolari.",".$paredblolad.",".$paredmad.",".$pisomoscer.","
	.$cielorazo.",".$energcocinar2.",".$energcocinar4.",".$elimbasu1.","
	.$hogar_nin.",".$dependency.",".$edjefe.",".$meaneduc.","
	.$overcrowding.",".$computer.",".$qmobilephone.","
	.$lugar1.",".$wall_condition.",".$roof_condition.","
	.$floor_condition;
	
	system("python3 PMT_model_execute.py ".$model_name." ".$inputs." 2&>1");
}
if($message == "remove")
{
	$filename = $_GET["filename"];
	system("python3 PMT_deletefile.py ".$filename." 2>&1");
}
if($message == "csvfilesquantity")
{
	system("python3 PMT_get_csvquantity.py");
}
if($message == "listofcsvfiles")
{
	$index = $_GET["index"];
	system("python3 PMT_list_csvfiles.py ".$index." 2>&1");
}
if($message == "getrandomrow")
{
	$linenumber = $_GET["linenumber"];
	system("python3 PMT_get_randomrow.py ".$linenumber." 2>&1");
}

?>
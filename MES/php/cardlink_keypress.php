<?php
include_once("../classes/card.php");
include_once("../classes/cardlink_check.php");
include_once("../classes/modelRoute.php");
include_once("../classes/station.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serial1']);
	$serialno2 = explode(" ",$_GET['serial2']);
	$Serial = new Card($account,$serialno[0]);
	
	$exist = Card::checkExist($account,$serialno[0]);
	$exist2 = Card::checkExist($account,$serialno2[0]);
	$serial1_model = $_GET['model1'];
	$serial2_model = $_GET['model2'];
	$sn = $_GET['sn'];
	
		
		if($sn=='serial1')
		{
			if($exist == 'true')
			{

				/*$serial1_model=$Serial->getpartno();*/
				$model = new Check($account,$serial1_model);
				$modelexist = Check::checkExist($account,$serial1_model);
				if($Serial->getpartno()==$serial1_model)
				{
					$Station = new Station();
					$ModelRoute = new ModelRoute();
					$Station->StationDetails($account,$Serial->getCurtStage());
					$discription = $Station->getDescription();
					$ModelRoute->setAccount($account);
					$ModelRoute->setStation($Serial->getCurtStage());
					$ModelRoute->setModelNo($Serial->getPartNo());
					$ModelRoute->getStationDetails2();
					$nextstage = explode(": ",$ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence()));
					if($nextstage[0]==$model->getstation())
					{
						$serial1_prefix = substr($Serial->getserialno(),0,$model->getserial1_prefixlength());
						$serial1_prefixlength = strlen(substr($Serial->getserialno(),0,$model->getserial1_prefixlength()));
						$serial1_length = strlen($Serial->getserialno());
						
						if($model->getserial1_prefix()==$serial1_prefix && $model->getserial1_prefixlength() == $serial1_prefixlength && $model->getserial1_length()==$serial1_length)
						{
							
							if($Serial->getstatus()=='GOOD')
							{
								/*$result='';
								$linkmodel = Check::getAllmodellink($account,$serial1_model);
								for($i=0;$i<count($linkmodel);$i++)
								{
									$result.=$linkmodel[$i]->getserial2_model()."_";
								}
								echo $result;*/
								echo 'ok_'.$Serial->getpartno().'_'.$Serial->getrevision().'_'.$nextstage[1].'_'.$Serial->getstatus().'_'.$Serial->getlastupdatedBy();

							}
							else
							{
								echo 'snnotgood_'.$Serial->getserialno();
							}
						}
						else
						{
							echo 'wrongsnformat_'.$Serial->getserialno();
						}

					}
					else
					{
						echo 'offroute_'.$Serial->getserialno();
					}

				}
				else
				{
					echo 'wrongmodel_'.$Serial->getserialno();
				}


			}
			else if($exist=='false')
			{
				echo 'notexist_'.$Serial->getserialno();
			}
		}

		else if ($sn=='serial2')
		{	

			/*$serial1_model = $Serial->getpartno();*/
			$Serial2 = new Card($account,$serialno2[0]);
			$modelexist = Check::checkExist2($account,$serial1_model,$serial2_model);
			$model = new Check($account,$serial1_model,$serial2_model);
			
			if($modelexist=='true')
			{
				
				if($model->getserial2Reg()==0)
				{
					$exist2 = Card::checkExist($account,$serialno2[0]);
					
					if($exist2=='true')
					{
						/*$serial2_prefix = substr($serialno2, 0,$model->getserial2_prefixlength());
						$serial2_length = strlen($serialno2);*/
						
						if($serial2_model==$Serial2->getpartno())
						{
							/*echo 'sn2exist_',$serial2_model,$Serial2->getpartno();*/
							$Station = new Station();
							$ModelRoute = new ModelRoute();
							$Station->StationDetails($account,$Serial2->getCurtStage());
							$discription = $Station->getDescription();
							$ModelRoute->setAccount($account);
							$ModelRoute->setStation($Serial2->getCurtStage());
							$ModelRoute->setModelNo($Serial2->getPartNo());
							$ModelRoute->getStationDetails2();
							/*$nextstage = explode(": ",$ModelRoute->getnextstage1($account,$Serial2->getPartNo(),$ModelRoute->getFlowsequence()));*/
							$ModelRoute->getFirstStation();
							
							
							if($ModelRoute->getStation()==$model->getstation())
							{
								if($Serial2->getstatus()=='GOOD')
								{
									echo 'ok_'.$model->getstation();
									
								}
								else
								{
									echo 'sn2notgood_';
								}
							}
							else
							{
								echo 'sn2offroute_';

							}

						}
						else
						{
							echo 'sn2wrongmodel_';
						}
					}
					else
					{
						
						echo 'sn2notexist_';

					}
					

				}
				else
				{
					
					$serial1_prefix = substr($serialno[0], 0,$model->getserial1_prefixlength());
					$serial1_length=strlen($serialno[0]);
					$serial2_prefix=substr($serialno2[0], 0,$model->getserial2_prefixlength());
					$serial2_length=strlen($serialno2[0]);
					$checkformat = Check::checksnformat($account,$serial1_model,$serial2_model,$serial1_prefix,$serial1_length,$serial2_prefix,$serial2_length);
					if($checkformat=='true')
					{
						$exist2 = Card::checkExist($account,$serialno2[0]);
						if($exist2=='false')
						{
							echo 'ok_',$model->getstation();
						}
						else
						{
							echo 'sn2alreadyexist_';
						}
					}
					else
					{
						echo 'wrongsn2format_';
					}
				}
			}
			else
			{
				echo 'notcompatible_'.$Serial->getserialno();
			}
			
		}


?>
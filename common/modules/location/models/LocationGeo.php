<?php

namespace common\modules\location\models;

use Yii;

/**
 * Class LocationGeo - get and set location by IP
 * @package common\models
 */
class LocationGeo extends \yii\base\Object
{
	private $fhandleCIDR, $fhandleCities, $fSizeCIDR, $fsizeCities, $ip;

	public $cidr_optim = __DIR__ . '/../assets/cidr_optim.txt';
	public $cities = __DIR__ . '/../assets/cities.txt';

	/**
	 * Geoip constructor.
	 */
	function __construct()
	{
		$this->fhandleCIDR = fopen($this->cidr_optim, 'r') or die("Cannot open $this->cidr_optim");
		$this->fhandleCities = fopen($this->cities, 'r') or die("Cannot open $this->cities");

		$this->fSizeCIDR = filesize($this->cidr_optim);
		$this->fsizeCities = filesize($this->cities);

		$this->ip = sprintf('%u', ip2long(Yii::$app->request->userIP));
	}

	/**
	 * @param $idx
	 * @return array|bool
	 */
	private function getCityByIdx($idx)
	{
		rewind($this->fhandleCities);

		while(!feof($this->fhandleCities)) {

			$str = fgets($this->fhandleCities);
			$arRecord = explode("\t", trim($str));

			if($arRecord[0] == $idx)
				return [
					'city' => $arRecord[1],
					'region' => $arRecord[2],
					'district' => $arRecord[3],
					'lat' => $arRecord[4],
					'lng' => $arRecord[5]
				];
		}

		return false;
	}

	/**
	 * @return array|bool
	 */
	function getByIp()
	{
		rewind($this->fhandleCIDR);
		$rad = floor($this->fSizeCIDR / 2);
		$pos = $rad;

		while(fseek($this->fhandleCIDR, $pos, SEEK_SET) != -1) {

			if ($rad) $str = fgets($this->fhandleCIDR);
			else rewind($this->fhandleCIDR);

			$str = fgets($this->fhandleCIDR);

			if(!$str)
				return false;

			$arRecord = explode("\t", trim($str));

			$rad = floor($rad / 2);

			if(!$rad && ($this->ip < $arRecord[0] || $this->ip > $arRecord[1]))
				return false;

			if ($this->ip < $arRecord[0]) $pos -= $rad;
			elseif ($this->ip > $arRecord[1]) $pos += $rad;
			else {
				$result = array('range' => $arRecord[2], 'cc' => $arRecord[3]);

				if($arRecord[4] != '-' && $cityResult = $this->getCityByIdx($arRecord[4]))
					$result += $cityResult;

				return $result;
			}
		}

		return false;
	}
}
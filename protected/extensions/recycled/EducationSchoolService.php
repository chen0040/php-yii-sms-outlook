<?php

class EducationSchoolService extends CComponent
{
	private $singapore_schools=null;
	private $china_schools=null;
	
	public function __construct()
	{
	}

	public function init()
	{
	}
	
	public function getSchoolsByCountry($country)
	{		
		if($country==='Singapore')
		{
			if(isset($this->singapore_schools))
			{
				return $this->singapore_schools;
			}
			
			$this->singapore_schools=array();
			
			//Singapore
			$singapore_singapore_singapore_schools=array(
			'Nanyang Technological University',
			'National University of Singapore',
			'Singapore Management University',
			'Singapore Institute of Technology',
			'Singapore University of Technology and Design',
			'SIM University',
			);
			
			$singapore_singapore_schools=array();
			$singapore_singapore_schools['Singapore']=$singapore_singapore_singapore_schools;
			$this->singapore_schools['Singapore']=$singapore_singapore_schools;
			
			return $this->singapore_schools;
		}
		else if($country==='China')
		{
			if(isset($this->china_schools))
			{
				return $this->china_schools;
			}
			
			$this->china_schools=array();
			
			//China, Beijing
			$china_beijing_beijing_schools=array(
			'Peking University',
			'Tsinghua University',
			'Renmin University of China',
			'Beijing Normal University',
			'Beihang University', 
			'Beijing Institute of Technology', 
			'China Agricultural University',
			);
			
			$china_beijing_schools=array();
			$china_beijing_schools['Beijing']=$china_beijing_beijing_schools;
			$this->china_schools['Beijing']=$china_beijing_schools;
			
			//China, Tianjing
			$china_tianjing_tianjing_schools=array(
			'Nankai University', 
			'Tianjin University',
			);
			
			$china_tianjing_schools=array();
			$china_tianjing_schools['Tianjing']=$china_tianjing_tianjing_schools;
			$this->china_schools['Tianjing']=$china_tianjing_schools;
			
			//China, Jiangsu
			$china_jiangsu_nanjing_schools=array(
			'Nanjing University', 
			'Southeast University',
			);
			
			$china_jiangsu_schools=array();
			$china_jiangsu_schools['Nanjing']=$china_jiangsu_nanjing_schools;
			$this->china_schools['Jiangsu']=$china_jiangsu_schools;
			
			//China, Anhui
			$china_anhui_hefei_schools=array(
			'University of Science and Technology of China', 
			);
			
			$china_anhui_schools=array();
			$china_anhui_schools['Hefei']=$china_anhui_hefei_schools;
			$this->china_schools['Anhui']=$china_anhui_schools;
			
			//China, Zhejiang, 
			$china_zhejiang_hangzhou_schools=array(
			'Zhejiang University', 
			);
			
			$china_zhejiang_schools=array();
			$china_zhejiang_schools['Hangzhou']=$china_zhejiang_hangzhou_schools;
			$this->china_schools['Zhejiang']=$china_zhejiang_schools;
			
			//China,  Shandong, Jinan
			$china_shandong_jinan_schools=array(
			'Shandong University', 
			);
			
			//China, Shandong, Qingdao
			$china_shandong_qingdao_schools=array(
			'Ocean University of China',
			);
			
			$china_shandong_schools=array();
			$china_shandong_schools['Jinan']=$china_shandong_jinan_schools;
			$china_shandong_schools['Qingdao']=$china_shandong_qingdao_schools;
			$this->china_schools['Shandong']=$china_shandong_schools;
			
			//China, Shanghai
			$china_shanghai_shanghai_schools=array(
			'Fudan University', 
			'Shanghai Jiao Tong University', 
			'Tongji University', 
			'East China Normal University',
			);
			
			$china_shanghai_schools=array();
			$china_shanghai_schools['Shanghai']=$china_shanghai_shanghai_schools;
			$this->china_schools['Shanghai']=$china_shanghai_schools;
			
			//China, Shaanxi, Xi'an
			$china_xian_shaanxi_schools=array(
			'Xi\'an Jiao Tong University', 
			'Northwestern Polytechnical University',
			);
			
			$china_xian_schools=array();
			$china_xian_schools['Shaanxi']=$china_xian_shaanxi_schools;
			$this->china_schools['Xi\'an']=$china_xian_schools;
			
			//China, Sichuan, Chengdu
			$china_sichuan_chengdu_schools=array(
			'Sichuan University', 
			'University of Electronic Science and Technology of China',
			);
			
			$china_sichuan_schools=array();
			$china_sichuan_schools['Chengdu']=$china_sichuan_chengdu_schools;
			$this->china_schools['Sichuan']=$china_sichuan_schools;
			
			//China, Gansu, Lanzhou
			$china_gansu_lanzhou_schools=array(
			'Lanzhou University', 
			);
			
			$china_gansu_schools=array();
			$china_gansu_schools['Lanzhou']=$china_gansu_lanzhou_schools;
			$this->china_schools['Gansu']=$china_gansu_schools;
			
			//China, Chongqing
			$china_chongqing_chongqing_schools=array(
			'Chongqing University',
			);
			
			$china_chongqing_schools=array();
			$china_chongqing_schools['Chongqing']=$china_chongqing_chongqing_schools;
			$this->china_schools['Chongqing']=$china_chongqing_schools;
			
			//China, (Wuhan, Hubei), 
			$china_hubei_wuhan_schools=array(
			'Wuhan University',
			'Huazhong University of Science and Technology',
			);
			
			$china_hubei_schools=array();
			$china_hubei_schools['Wuhan']=$china_hubei_wuhan_schools;
			$this->china_schools['Hubei']=$china_hubei_schools;
			
			//China, (Changsha, Hunan), 
			$china_hunan_changsha_schools=array(
			'National University of Defense Technology', 
			'Central South University',
			);
			
			$china_hunan_schools=array();
			$china_hunan_schools['Changsha']=$china_hunan_changsha_schools;
			$this->china_schools['Hunan']=$china_hunan_schools;
			
			//China, (Guangzhou, Guangdong), 
			$china_guangdong_guangzhou_schools=array(
			'Sun Yat-sen University',
			'South China University of Technology',
			);
			
			$china_guangdong_schools=array();
			$china_guangdong_schools['Guangzhou']=$china_guangdong_guangzhou_schools;
			$this->china_schools['Guangdong']=$china_guangdong_schools;
			
			//China, (Xiamen, Fujian), 
			$china_xiamen_fujian_schools=array(
			'Xiamen University', 
			);
			
			$china_xiamen_schools=array();
			$china_xiamen_schools['Fujian']=$china_xiamen_fujian_schools;
			$this->china_schools['Xiamen']=$china_xiamen_schools;
			
			//China, (Harbin, Heilongjiang), 
			$china_harbin_heilongjiang_schools=array(
			'Harbin Institute of Technology',
			);
			
			$china_harbin_schools=array();
			$china_harbin_schools['Heilongjiang']=$china_harbin_heilongjiang_schools;
			$this->china_schools['Harbin']=$china_harbin_schools;
			
			//China, (Dalian, Liaoning), 
			$china_liaoning_dalian_schools=array(
			'Dalian University of Technology',
			);
			
			$china_liaoning_schools=array();
			$china_liaoning_schools['Dalian']=$china_liaoning_dalian_schools;
			$this->china_schools['Liaoning']=$china_liaoning_schools;
			
			//China, (Changchun, Jilin) 
			$china_jilin_changchun_schools=array(
			'Jilin University',
			);
			
			$china_jilin_schools=array();
			$china_jilin_schools['Changchun']=$china_jilin_changchun_schools;
			$this->china_schools['Jilin']=$china_jilin_schools;
			
			//China, Hongkong
			$china_hongkong_hongkong_schools=array(
			'The University of Hong Kong', 
			'The Chinese University of Hong Kong', 
			'The Hong Kong University of Science and Technology', 
			'The Hong Kong Polytechnic University', 
			'City University of Hong Kong', 
			'Hong Kong Baptist University',
			);
			
			$china_hongkong_schools=array();
			$china_hongkong_schools['Hongkong']=$china_hongkong_hongkong_schools;
			$this->china_schools['Hongkong']=$china_hongkong_schools;
			
			//China, Macau
			$china_macau_macau_schools=array(
			'University of Macau',
			);
			
			$china_macau_schools=array();
			$china_macau_schools['Macau']=$china_macau_macau_schools;
			$this->china_schools['Macau']=$china_macau_schools;
			
			//China, Taiwan, Taibei
			$china_taiwan_taibei_schools=array(
			'National Taiwan University', 
			'National Yang Ming University', 
			'National Taiwan University of Science and Technology',
			);
			
			//China, Taiwan, Tainan
			$china_taiwan_tainan_schools=array(
			'National Cheng Kung University',
			);
			
			//China, Taiwan, Hsinchu
			$china_taiwan_hsinchu_schools=array(
			'National Tsing Hua University', 
			'National Chiao Tung University',
			);
			
			//China, Taiwan, Taoyuan
			$china_taiwan_taoyuang_schools=array(
			'National Central University',
			);
			
			//China, Taiwan, Kaohsiung	
			$china_taiwan_kaohsiung_schools=array(
			'National Sun Yat-sen University',
			);
			
			$china_taiwan_schools=array();
			$china_taiwan_schools['Taibei']=$china_taiwan_taibei_schools;
			$china_taiwan_schools['Tainan']=$china_taiwan_tainan_schools;
			$china_taiwan_schools['Hsinchu']=$china_taiwan_hsinchu_schools;
			$china_taiwan_schools['Taoyuan']=$china_taiwan_taoyuang_schools;
			$china_taiwan_schools['Kaohsiung']=$china_taiwan_kaohsiung_schools;
			$this->china_schools['Taiwan']=$china_taiwan_schools;

			return $this->china_schools;
		}
		
		return array();
	}
	
	public function getCountries()
	{
		return array('China', 'Singapore');
	}
	
	public function getProvinces($country)
	{
		$provinces=array();
		$schools=$this->getSchoolsByCountry($country);
		foreach($schools as $key => $val)
		{
			$provinces[]=$key;
		}
	
		return $provinces;
	}
	
	public function getCities($country, $province)
	{
		$cities=array();
		$schools=$this->getSchoolsByCountry($country);
		if(isset($schools[$province]))
		{
			$province_schools=$schools[$province];
			if(isset($province_schools))
			{
				foreach($province_schools as $key => $val)
				{
					$cities[]=$key;
				}
			}
		}
		return $cities;
	}
	
	public function getSchoolsByLocation($country, $province, $city)
	{
		$country_schools=$this->getSchoolsByCountry($country);
		return $country_schools[$province][$city];
		/*
		if(isset($country_schools[$province]))
		{
			$province_schools=$country_schools[$province];
			if(isset($province_schools))
			{
				if(isset($province_schools[$city]))
				{
					$city_schools=$province_schools[$city];
					if(isset($city_schools[$city]))
					{
						return $city_schools[$city];
					}
				}
			}
		}
		return array();*/
	}
	
	public function getSchools()
	{
		$schools=array();
		$countries=$this->getCountries();
		foreach($countries as $country)
		{
			$country_schools=$this->getSchoolsByCountry($country);
			foreach($country_schools as $province => $val1)
			{
				$country_province_schools=$val1;
				foreach($country_province_schools as $city => $val2)
				{
					$country_province_city_schools=$val2;
					foreach($country_province_city_schools as $val3)
					{
						$schools[]=($val3.', '.$city.', '.$province.', '.$country);
					}
				}
			}
		}
		/*
		//Singapore
		$schools=array('Nanyang Technological University',
		'National University of Singapore',
		'Singapore Management University',
		'Singapore Institute of Technology',
		'Singapore University of Technology and Design',
		'SIM University',
		
		//China, Beijing
		'Peking University',
		'Tsinghua University',
		'Renmin University of China',
		'Beijing Normal University',
		'Beihang University', 
		'Beijing Institute of Technology', 
		'China Agricultural University',
		
		//China, Tianjin
		'Nankai University', 
		'Tianjin University',
		
		//China, Jiangsu, Nanjing
		'Nanjing University', 
		'Southeast University',
		
		//China, Anhui, Hefei
		'University of Science and Technology of China', 
		
		//China, Zhejiang, Hangzhou
		'Zhejiang University', 
		
		//China,  Shandong, Jinan
		'Shandong University', 
		
		//China, Shandong, Qingdao
		'Ocean University of China',
		
		//China, Shanghai
		'Fudan University', 
		'Shanghai Jiao Tong University', 
		'Tongji University', 
		'East China Normal University',
		
		//China, Shaanxi, Xi'an
		'Xi\'an Jiao Tong University', 
		'Northwestern Polytechnical University',
		
		//China, Sichuan, Chengdu
		'Sichuan University', 
		'University of Electronic Science and Technology of China',
		
		//China, Gansu, Lanzhou
		'Lanzhou University', 
		
		//China, Chongqing
		'Chongqing University',
		
		//China, (Wuhan, Hubei), 
		'Wuhan University',
		'Huazhong University of Science and Technology',
		
		//China, (Changsha, Hunan), 
		'National University of Defense Technology', 
		'Central South University',
		
		//China, (Guangzhou, Guangdong), 
		'Sun Yat-sen University',
		'South China University of Technology',
		
		//China, (Xiamen, Fujian), 
		'Xiamen University', 
		
		//China, (Harbin, Heilongjiang), 
		'Harbin Institute of Technology',
		
		//China, (Dalian, Liaoning), 
		'Dalian University of Technology',
		
		//China, (Changchun, Jilin) 
		'Jilin University',
		
		//China, Hongkong
		'The University of Hong Kong', 
		'The Chinese University of Hong Kong', 
		'The Hong Kong University of Science and Technology', 
		'The Hong Kong Polytechnic University', 
		'City University of Hong Kong', 
		'Hong Kong Baptist University',
		
		//China, Macau
		'University of Macau',
		
		//China, Taiwan, Taibei
		'National Taiwan University', 
		'National Yang Ming University', 
		'National Taiwan University of Science and Technology',
		
		//China, Taiwan, Tainan
		'National Cheng Kung University',
		
		//China, Taiwan, Hsinchu
		'National Tsing Hua University', 
		'National Chiao Tung University',
		
		//China, Taiwan, Taoyuan
		'National Central University',
		
		//China, Taiwan, Kaohsiung	
		'National Sun Yat-sen University',
		);*/
		
		
		return $schools;
	}
}

?>
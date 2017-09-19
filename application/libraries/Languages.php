<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
 * Languages Library class
 *
 * Extension of the CI core classes and communicate with the controller (The side man)
 *
 * @package		ci_fullcalendar
 * @category    Library
 * @author		sirdre
 * @link		Application/libraries/Languages
 */ 
  

class Languages {

	//global variable
	protected $CI;
	
	/**
	* Constructor
	*
	* @access    public
	*/
	function __construct() {
		$this->CI = &get_instance();
		
		$this->CI->load->helper('security'); 
		$this->CI->load->helper('language');
		$this->CI->load->helper('string');
		$this->CI->load->helper('url'); 
		 
		log_message('debug', "Languages Class Initialized");
	}
	
	
    public function get_lang($lang) {
		
		//Check user is logged and user		
		if($lang =='en') {
			$this->CI->lang->load('en', 'english');			
			$this->CI->lang->load('auth', 'english');
			$this->CI->lang->load('ion_auth', 'english');
		}else if($lang =='ar') {
			$this->CI->lang->load('ar', 'arabic');			
			$this->CI->lang->load('auth', 'arabic');
			$this->CI->lang->load('ion_auth', 'arabic');
		} else if($lang == 'fr'){
			$this->CI->lang->load('fr', 'french'); 
			$this->CI->lang->load('auth', 'french');
			$this->CI->lang->load('ion_auth', 'french');
		} else if($lang == 'es'){
			$this->CI->lang->load('es', 'spanish'); 
			$this->CI->lang->load('auth', 'spanish');
			$this->CI->lang->load('ion_auth', 'spanish');
		} else if($lang == 'pt'){
			$this->CI->lang->load('pt', 'portuguese'); 
			$this->CI->lang->load('auth', 'portuguese');
			$this->CI->lang->load('ion_auth', 'portuguese');
		} else if($lang == 'id'){
			$this->CI->lang->load('id', 'indonesian'); 
			$this->CI->lang->load('auth', 'indonesian');
			$this->CI->lang->load('ion_auth', 'indonesian');
		} else if($lang == 'it'){
			$this->CI->lang->load('it', 'italian'); 
			$this->CI->lang->load('auth', 'italian');
			$this->CI->lang->load('ion_auth', 'italian');
		} else if($lang == 'nl'){
			$this->CI->lang->load('nl', 'dutch'); 
			$this->CI->lang->load('auth', 'dutch');
			$this->CI->lang->load('ion_auth', 'dutch');
		} else if($lang == 'ru'){
			$this->CI->lang->load('ru', 'russian'); 
			$this->CI->lang->load('auth', 'russian');
			$this->CI->lang->load('ion_auth', 'russian');
		} else if($lang == 'ja'){
			$this->CI->lang->load('ja', 'japanese'); 
			$this->CI->lang->load('auth', 'japanese');
			$this->CI->lang->load('ion_auth', 'japanese');
		} else if($lang == 'ko'){
			$this->CI->lang->load('ko', 'korean'); 
			$this->CI->lang->load('auth', 'korean');
			$this->CI->lang->load('ion_auth', 'korean');
		} else if($lang == 'vi'){
			$this->CI->lang->load('vi', 'vietnamese'); 
			$this->CI->lang->load('auth', 'vietnamese');
			$this->CI->lang->load('ion_auth', 'vietnamese');
		} else if($lang == 'zh-cn'){
			$this->CI->lang->load('zh-cn', 'chinese'); 
			$this->CI->lang->load('auth', 'chinese');
			$this->CI->lang->load('ion_auth', 'chinese');
		} else {
			$this->CI->lang->load('en', 'english');
		}
    }	
	
 	public function langtotime($date_string, $lang) { 
 
		if($lang == 'ar'){
			$str = strtotime(strtr(strtolower($date_string), array('كانون الثاني يناير'=>'jan','شباط فبراير'=>'feb','آذار مارس'=>'march','نيسان أبريل'=>'apr','أيار مايو'=>'may','حزيران يونيو'=>'jun','تموز يوليو'=>'jul','آب أغسطس'=>'aug','أيلول سبتمبر'=>'sep','تشرين الأول أكتوبر'=>'oct','تشرين الثاني نوفمبر'=>'nov','كانون الأول ديسمبر'=>'dec','ص'=>'am','م'=>'pm','١'=>'1','٢'=>'2','٣'=>'3','٤'=>'4','٥'=>'5','٦'=>'6','٧'=>'7','٨'=>'8','٩'=>'9','٠'=>'0'))); 
		} else if($lang == 'fr'){
			$str = strtotime(strtr(strtolower($date_string), array('janvier'=>'jan','février'=>'feb','mars'=>'march','avril'=>'apr','mai'=>'may','juin'=>'jun','juillet'=>'jul','août'=>'aug','septembre'=>'sep','octobre'=>'oct','novembre'=>'nov','décembre'=>'dec'))); 
		} else if($lang == 'es'){
			$str = strtotime(strtr(strtolower($date_string), array('enero'=>'jan','febrero'=>'feb','marzo'=>'march','abril'=>'apr','mayo'=>'may','junio'=>'jun','julio'=>'jul','agosto'=>'aug','septiembre'=>'sep','octubre'=>'oct','noviembre'=>'nov','diciembre'=>'dec'))); 
		} else if($lang == 'pt'){
			$str = strtotime(strtr(strtolower($date_string), array('janeiro'=>'jan','fevereiro'=>'feb','março'=>'march','abril'=>'apr','maio'=>'may','junho'=>'jun','julho'=>'jul','agosto'=>'aug','setembro'=>'sep','outubro'=>'oct','novembro'=>'nov','dezembro'=>'dec'))); 
		} else if($lang == 'nl'){
			$str = strtotime(strtr(strtolower($date_string), array('januari'=>'jan','februari'=>'feb','maart'=>'march','april'=>'apr','mei'=>'may','juni'=>'jun','juli'=>'jul','augustus'=>'aug','september'=>'sep','oktober'=>'oct','november'=>'nov','december'=>'dec'))); 
		} else if($lang == 'nb'){
			$str = strtotime(strtr(strtolower($date_string), array('januar'=>'jan','februar'=>'feb','mars'=>'march','april'=>'apr','mai'=>'may','juni'=>'jun','juli'=>'jul','august'=>'aug','september'=>'sep','oktober'=>'oct','november'=>'nov','desember'=>'dec'))); 
		} else if($lang == 'de' || $lang == 'de-at'){
			$str = strtotime(strtr(strtolower($date_string), array('januar'=>'jan','februar'=>'feb','märz'=>'march','april'=>'apr','mai'=>'may','juni'=>'jun','juli'=>'jul','august'=>'aug','september'=>'sep','oktober'=>'oct','november'=>'nov','dezember'=>'dec'))); 
		} else if($lang == 'id'){
			$str = strtotime(strtr(strtolower($date_string), array('januari'=>'jan','februari'=>'feb','maret'=>'march','april'=>'apr','mei'=>'may','juni'=>'jun','juli'=>'jul','agustus'=>'aug','september'=>'sep','oktober'=>'oct','november'=>'nov','desember'=>'dec','pagi'=>'am','siang'=>'pm'))); 
		} else if($lang == 'it'){
			$str = strtotime(strtr(strtolower($date_string), array('gennaio'=>'jan','febbraio'=>'feb','marzo'=>'march','aprile'=>'apr','maggio'=>'may','giugno'=>'jun','luglio'=>'jul','agosto'=>'aug','settembre'=>'sep','ottobre'=>'oct','novembre'=>'nov','dicembre'=>'dec'))); 
		} else if($lang == 'ru'){
			$str = strtotime(strtr(strtolower($date_string), array('январь'=>'jan','февраль'=>'feb','март'=>'march','апрель'=>'apr','май'=>'may','июнь'=>'jun','июль'=>'jul','август'=>'aug','сентябрь'=>'sep','октябрь'=>'oct','ноябрь'=>'nov','декабрь'=>'dec','ночи'=>'am','дня'=>'pm'))); 
		} else if($lang == 'sv'){
			$str = strtotime(strtr(strtolower($date_string), array('januari'=>'jan','februari'=>'feb','mars'=>'march','april'=>'apr','maj'=>'may','juni'=>'jun','juli'=>'jul','augusti'=>'aug','september'=>'sep','oktober'=>'oct','november'=>'nov','december'=>'dec'))); 
		} else if($lang == 'tr' || $lang == 'tur'){
			$str = strtotime(strtr(strtolower($date_string), array('ocak'=>'jan','şubat'=>'feb','mart'=>'march','nisan'=>'apr','mayıs'=>'may','haziran'=>'jun','temmuz'=>'jul','ağustos'=>'aug','eylül'=>'sep','ekim'=>'oct','kasım'=>'nov','aralık'=>'dec'))); 
		} else if($lang == 'th'){
			$str = strtotime(strtr(strtolower($date_string), array('มกราคม'=>'jan','กุมภาพันธ์'=>'feb','มีนาคม'=>'march','เมษายน'=>'apr','พฤษภาคม'=>'may','มิถุนายน'=>'jun','กรกฎาคม'=>'jul','สิงหาคม'=>'aug','กันยายน'=>'sep','ตุลาคม'=>'oct','พฤศจิกายน'=>'nov','ธันวาคม'=>'dec','ก่อนเที่ยง'=>'am','หลังเที่ยง'=>'pm'))); 
		} else if($lang == 'vi'){
			$str = strtotime(strtr(strtolower($date_string), array('tháng 1'=>'jan','tháng 2'=>'feb','tháng 3'=>'march','tháng 4'=>'apr','tháng 5'=>'may','tháng 6'=>'jun','tháng 7'=>'jul','tháng 8'=>'aug','tháng 9'=>'sep','tháng 10'=>'oct','tháng 11'=>'nov','tháng 12'=>'dec'))); 
		} else if($lang == 'ko'){
			$str = strtotime(strtr(strtolower($date_string), array('1월'=>'jan','2월'=>'feb','3월'=>'march','4월'=>'apr','5월'=>'may','6월'=>'jun','7월'=>'jul','8월'=>'aug','9월'=>'sep','10월'=>'oct','11월'=>'nov','12월'=>'dec','오전'=>'am','오후'=>'pm'))); 
		} else if($lang == 'ja'){
			$str = strtotime(strtr(strtolower($date_string), array('1月'=>'jan','2月'=>'feb','3月'=>'march','4月'=>'apr','5月'=>'may','6月'=>'jun','7月'=>'jul','8月'=>'aug','9月'=>'sep','10月'=>'oct','11月'=>'nov','12月'=>'dec','午前'=>'am','午後'=>'pm'))); 
		} else if($lang == 'zh-cn' || $lang == 'zh-tw'){
			$str = strtotime(strtr(strtolower($date_string), array('一月'=>'jan','二月'=>'feb','三月'=>'march','四月'=>'apr','五月'=>'may','六月'=>'jun','七月'=>'jul','八月'=>'aug','九月'=>'sep','十月'=>'oct','十一月'=>'nov','十二月'=>'dec','凌晨'=>'am','中午'=>'pm'))); 
		} else{
			$str = strtotime($date_string);
		}
	
		return $str;
	}
	

}

/* End of file language.php */
/* Location: ./application/libraries/language.php */
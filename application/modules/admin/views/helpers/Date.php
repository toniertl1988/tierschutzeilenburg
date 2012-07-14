<?php
class Admin_View_Helper_Date extends Zend_View_Helper_Abstract
{
	public function date($date)
	{
		return strftime('%d.%m.%Y', strtotime($date));
	}
}
<?php
class Admin_View_Helper_DateTime extends Zend_View_Helper_Abstract
{
	public function dateTime($date)
	{
		return strftime('%e.%m.%Y %H:%M:%S', strtotime($date));
	}
}
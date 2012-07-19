<?php
class GuestbookController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$model = new System_Model_Guestbook();
		// TOOD: antworten fetchen und mit in array packen
		$entries = $model->fetchAll2Array(false, 'id', 'DESC');
		for ($i = 0; $i < count($entries); $i++) {
			if (strlen($entries[$i]['answerTo'])) {
				for ($j = 0; $j < count($entries); $j++) {
					if ($entries[$j]['id'] == $entries[$i]['answerTo']) {
						$entries[$j]['answer'] = $entries[$i];
						unset($entries[$i]);
					}
				}
			}
		}
		$paginator = Zend_Paginator::factory($entries);
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(25);
		$this->view->paginator = $paginator;		
	}
	
	public function writeAction()
	{
		
	}
	
}
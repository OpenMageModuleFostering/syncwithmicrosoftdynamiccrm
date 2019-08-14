<?php

class Thylak_Magemicrosoft_Adminhtml_MagemicrosoftController extends Mage_Adminhtml_Controller_action
{

	public function indexAction()
	{   
		$this->loadLayout()
		->_addContent($this->getLayout()->createBlock('magemicrosoft/adminhtml_magemicrosoft_magemicrosoft'))
		->_setActiveMenu('magemicrosoft/items')
		->renderLayout();
	}
	
	public function thanksAction()
	{   
		$this->loadLayout()
		->_addContent($this->getLayout()->createBlock('magemicrosoft/adminhtml_magemicrosoft_thanks'))
		->_setActiveMenu('magemicrosoft/items')
		->renderLayout();
	}
	
	public function savemagemicrosoftAction()
	{
        $fname=$this->getRequest()->getPost('firstname');
        $lname=$this->getRequest()->getPost('lastname');
        $email=$this->getRequest()->getPost('email');
        $company=$this->getRequest()->getPost('company');
        $ph=$this->getRequest()->getPost('phoneno');
        $productversion=$this->getRequest()->getPost('productversion');
        $desc=$this->getRequest()->getPost('description');
        $timetotalk=$this->getRequest()->getPost('timetotalk');
        
        $qrystr =  'FirstName='.str_replace(" ","%20",$fname).'&LastName='.str_replace(" ","%20",$lname).'&Email='.str_replace(" ","%20",$email).'&CompanyName='.str_replace(" ","%20",$company).'&Phone1='.str_replace(" ","%20",$ph).'&ProductVersion='.str_replace(" ","%20",$productversion).'&TimetoTalk='.str_replace(" ","%20",$timetotalk).'&CloseLeadComment='.str_replace(" ","%20",$desc).'&CreatedBy=139&SourceID=42';
        
        $url = "http://www.thylaksoft.com/addLead.aspx?".$qrystr;

        $mscrm = new Thylak_Magemicrosoft_Model_Magemicrosoft($url,$email,$fname,$lname);
		$res = $mscrm->callCurl();
		
		if($res=='success')
		{
            //try{
                //$salesforce->sendEmail();
            //}
            //catch(Exception $e){
                //echo $ex;
            //}            
			$this->getResponse()->setRedirect($this->getUrl('magemicrosoft/adminhtml_magemicrosoft/thanks/fname/'.$fname.'/lname/'.$lname, array('_secure'=>true)));
		}
		else
		{
			Mage::getSingleton('core/session')->addError('There was an Error occured. Please try after some time.'); 
			$this->getResponse()->setRedirect($this->getUrl('magemicrosoft/adminhtml_magemicrosoft/index/', array('_secure'=>true)));
		}
		return;
	}   

}
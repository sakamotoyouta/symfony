<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Inquiry;


/**
* @Route("inquiry")
*/
class InquiryController extends Controller{
	/**
	* @Route("/")
	* @Method("get")
	*/
	public function indexAction(){
			//テンプレートへ
			return $this->render('Inquiry/index.html.twig',['form'=>$this->createInquiryForm()->createView()]);
	}

	/**
	* @Route("/")
	* @Method("post")
	*/
	public function indexPostAction(Request $request){
		$form = $this->createInquiryForm();
		//リクエストをフォームに取り込む
		$form->handleRequest($request);
		if($form->isValid()){
			//メールの送信
			$inquiry = $form->getData();
			$em = $this->getDoctrine()->getManager();
			$em -> persist($inquiry);
			$em -> flush();
			$message = \Swift_Message::newInstance()
			->setSubject('Webサイトからのお問い合わせ')
			->setFrom('webmaster@example.com')
			->setTo('admin@example.com')
			->setBody($this->renderView('mail/inquiry.txt.twig',['data'=>$inquiry]));
			$this->get('mailer')->send($message);
			//完了画面の描画
			return $this->redirect($this->generateUrl('app_inquiry_complete'));
		}else{
			return $this->render('Inquiry/index.html.twig',['form'=>$form->createView()]);
		}
	}

	/**
	* @Route("/complete")
	*/
	public function completeAction(){
		return $this->render('Inquiry/complete.html.twig');
	}

	private function createInquiryForm(){
		//FormBuilder()はオブジェクトを返すのでメソッドチェーンができる
		return $this -> createFormBuilder(new Inquiry())
			->add('name','text')
			->add('email','text')
			->add('tel','text',['required'=>false])
			->add('type','choice',['choices'=>['公園について','その他'],'expanded'=>true])
			->add('content','textarea')
			->add('submit','submit',['label'=>'送信'])
			->getForm();//Formオブジェクトに変換
	}
}

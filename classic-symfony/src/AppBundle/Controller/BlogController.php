<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller{
	public function latestListAction(){
		$blogList = [
			[
				'targetDate' => '2015年３月１５日',
				'title' => '東京公演レポート'
			],
			[
				'targetDate' => '2015年２月８日',
				'title' => '最近の練習風景'
			],
			[
				'targetDate' => '2015年１月３日',
				'title' => '本年もよろしくお願いいたします'
			]
		];

		return $this->render('Blog/latestList.html.twig',['blogList' => $blogList]);
	}
}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ConcertController extends Controller{
	/**
	 * @Route("/concert/")
	 */
	public function indexAction(){
		$concertList = [
			[
				'date' => '2015年５月３日',
				'time' => '14:00',
				'place' => '東京文化会館',
				'available' => false
			],
			[
				'date' => '2015年７月12日',
				'time' => '14:00',
				'place' => '東京文化会館',
				'available' => true
			],
			[
				'date' => '2015年９月２０日',
				'time' => '14:00',
				'place' => '東京文化会館',
				'available' => false
			],
			[
				'date' => '2015年１１月８日',
				'time' => '14:00',
				'place' => '東京文化会館',
				'available' => true
			],
			[
				'date' => '2015年１月１０日',
				'time' => '14:00',
				'place' => '東京文化会館',
				'available' => false
			]
		];
		return $this->render('Concert/index.html.twig',['concertList'=> $concertList]);
	}
}

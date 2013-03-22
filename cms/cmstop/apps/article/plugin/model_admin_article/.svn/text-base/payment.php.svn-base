<?php

class plugin_payment extends object 
{
	private $article;
	
	public function __construct(& $article)
	{
		$this->article = $article;
	}
	
	public function before_add()
	{
		$this->count();
	}
	
	public function before_edit()
	{
		$this->count();
	}
	
	private function count()
	{
		$this->article->data['words_count'] = words_count($this->article->data['content'], config('config', 'charset'));
		$this->article->data['payment_price'] = floatval(setting('article', 'payment_price'));
		$this->article->data['payment'] = $this->article->data['words_count']*$this->article->data['payment_price'];
	}
}
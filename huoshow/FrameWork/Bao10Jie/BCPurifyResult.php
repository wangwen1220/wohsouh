<?php

class BCPurifyResult
{
	function __construct(){}
	function __destruct(){}

	public function isBusinessSuccess() 
	{
		return $this->m_businessSuccess;
	}

	public function setBusinessSuccess($businessSuccess) 
	{
		$this->m_businessSuccess = $businessSuccess;
	}
	
	public function setMarkresults($markresults) 
	{
		$this->m_markresults = $markresults != null ? $markresults :$markresults;
	}
	
	public function getMarkResult()
	{
		return $this->m_markresults;

	}
	
	public function getMarkCount()
	{
		return $this->m_markresults == null ? 0 : count($this->m_markresults);
	}
	
	public function getMarkError() {}
	
	protected $m_businessSuccess ;
	protected $m_markresults ;

	
}

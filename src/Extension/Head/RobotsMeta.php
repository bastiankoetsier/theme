<?php namespace Bkoetsier\Theme\Extension\Head;

class RobotsMeta extends Meta{

	protected $index;
	protected $follow;

	function __construct($index = true,$follow = true)
	{
		$this->index = $index;
		$this->follow = $follow;
		parent::__construct('robots',$this->compileContent());
	}

	protected function compileContent()
	{
		$content = $this->index ? 'index' : 'noindex';
		$content.=',';
		$content.= $this->follow ? 'follow': 'nofollow';
		return $content;
	}
}
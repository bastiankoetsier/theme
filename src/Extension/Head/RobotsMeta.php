<?php namespace Bkoetsier\Theme\Extension\Head;

class RobotsMeta extends Meta{

    /**
     * @var bool
     */
	protected $index;

    /**
     * @var bool
     */
	protected $follow;

    /**
     * @param bool $index
     * @param bool $follow
     */
	function __construct($index = true,$follow = true)
	{
		$this->index = $index;
		$this->follow = $follow;
		parent::__construct('robots',$this->compileContent());
	}

    /**
     * @return boolean
     */
    public function isIndex()
    {
        return $this->index;
    }

    /**
     * @return boolean
     */
    public function isFollow()
    {
        return $this->follow;
    }

    /**
     * @return string
     */
	protected function compileContent()
	{
		$content = $this->index ? 'index' : 'noindex';
		$content.=',';
		$content.= $this->follow ? 'follow': 'nofollow';
		return $content;
	}
}
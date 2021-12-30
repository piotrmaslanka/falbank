<?php
	/**
	 * libtemplate
	 * 
	 * Simple and effective templating
	 * 
	 * @author Piotr Maślanka
	 * @version 1.0
	 * @package techplatform
	 * @subpackage template
	 */
/**
 * Static for doing some extra stuff
 */
class APITemplate
{
	/**
	 * Grabs a template code or whole file
	 * @param string $id if fits x:y, then x is the filename and y template id. else includes only the file if expressed by x
	 */
	static function getTemplateCode($id)
	{
		$id = explode(':',$id);
		if (count($id)==1)
		{
			return file_get_contents($id[0]);
		} else
		{
			$file = file_get_contents($id[0]);
			$pm = apreg_match('/@@prog@@'.$id[1].'@@(.+?)@@endprog@@/s', $file);
			return $pm[1][0];	
		}
	}
}


/**
 * PHP-based template class for Techplatform
 */
class PHPAPLTemplate
{
	/**
	 * Function name for
	 * @var string 
	 */
	public $fname = '';
	/**
	 * Hasharray. value name => data
	 * @var array
	 */
	public $vars = array();			// @var hasharray
	/**
	 * Renders. 
	 * @return string rendered template
	 */
	function render()
	{
		$funcname = 'render'.$this->fname;
		return $funcname($this->vars);
	}
	/**
	 * Sets a variable
	 */
	function setText($name, $value)
	{
		$this->vars[$name] = $value;
	}
	/**
	 * Sets a blockvar
	 */
	function setBlock($name, $value)
	{
		sapKey($name, $value, $this->vars);
	}
}
/**
 * PHP-based templating for Techplatform
 */
class PHPAPLReader
{
	function __construct($filename)
	{
		include($filename);
	}
	function mkTemplate($tempname)
	{
		$pa = new PHPAPLTemplate();
		$pa->fname = $tempname;
		return $pa;
	}
}


/**
 * Class for reading Techplatform TAPL files
 */
class TAPLReader
{
	/**
	 * Houses templates
	 * @var array
	 */
	protected $templates = array();
	function __construct($filename)
	{
		$file = file_get_contents($filename);
		$taplprogs = apreg_match('/@@prog@@([A-Za-z0-9_]+?)@@(.+?)@@endprog@@/s', $file);
		for ($i=0; $i<count($taplprogs[1]); $i++)
		{
			$name = $taplprogs[1][$i];
			$code = $taplprogs[2][$i];
			$this->templates[$name] = new TAPLTemplate($name, $code);
		}
	}
	/**
	 * Gets a template
	 * @param string $name template name
	 * @return TAPLTemplate template
	 */
	function mkTemplate($name)
	{
		return clone $this->templates[$name];
	}
}
/**
 * a TAPL template
 */
class TAPLTemplate
{
	protected $code = '';			// @var string
	public $subblocks = array();	// @var string
	public $vars = array();			// @var hasharray
	public $blockvars = array();	// @var hasharray (name => hasharray(name=>value))
	public $blockcodes = array();	// @var hasharray (name => code)
	/**
	 * Sets a text variable
	 * @param string $name var name
	 * @param string $data var data
	 */
	function setText($name, $data)
	{
		$this->vars[$name] = $data;
	}
	/**
	 * Adds a block values
	 * @param string $name block name
	 * @param array $data hash array with var_name => value
	 */
	function setBlock($name, $data)
	{
		sapKey($name, $data, $this->blockvars);
	}
	/**
	 * Constructor
	 * @param string $name template name
	 * @param string $code template code
	 */
	function __construct($name, $code, $vars=array(), $subblocks=array())
	{
		$this->vars = $vars;
		$this->subblocks = $subblocks;
		$this->code = $code;
		
		
		$blocks = apreg_match('/@@block@@([A-Za-z0-9_]+?)@@(.+?)@@endblock@@/s', $this->code);
		for ($i=0; $i<count($blocks[1]); $i++)
			$this->blockcodes[$blocks[1][$i]] = trim($blocks[2][$i]);
		$this->code = preg_replace('/@@block@@([A-Za-z0-9_]+?)@@.+?@@endblock@@/s',
										'!@#$%${1}!@#$%', $this->code);
										


		/*
		 * Blocks go before subblocks because blocks may contain subblocks
		 */

		$subblocks = apreg_match('/@@subblock@@([A-Za-z0-9_]+?)@@(.+?)@@endsubblock@@/s', $this->code);
		for ($i=0; $i<count($subblocks[1]); $i++)
		{
			$this->subblocks[$subblocks[1][$i]] = trim($subblocks[2][$i]);
		}
		$this->code = preg_replace('/@@subblock@@([A-Za-z0-9_]+?)@@.+?@@endsubblock@@/s','',$this->code);

	}
	/**
	 * Renders stuff
	 * @return string rendered content
	 */
	function render()
	{
		$this->solveIncludes($this->code);
		$this->inflateBlocks($this->code);
		$this->substVars($this->code);
		return $this->code;
	}
	/**
	 * Handles expanding of blocks
	 * @param string &$code current code
	 */
	protected function inflateBlocks(&$code)
	{
		$code = preg_replace_callback('/\!\@\#\$\%([A-Za-z0-9_]+?)\!\@\#\$\%/', 
			array($this,'inflateblock'),
			$code);
	}
	/**
	 * Substitutes variable references with variables
	 * @param string &$code current code
	 */
	protected function substVars(&$code)
	{
		$code = preg_replace_callback('/%(.+?)%/', array($this,'pfgetvar'), $code);
	}
	/**
	 * Solves includes, if-includes and if-subblocks
	 * @param string &$code current code
	 */
	protected function solveIncludes(&$code)
	{
		while ($xa = preg_match('/@@((ifs)|(ifi)|(include))@@(.+?)@@/',$code))
		{
						// includes
			$code = preg_replace_callback('/@@include@@(.+?)@@/',
					create_function('$match','return APITemplate::getTemplateCode($match[1]);'),
					$code);
					
						// if-include with else
			$code = preg_replace_callback('/@@ifi@@([A-Za-z0-9_]+?)=(.+?)@@(.+?)@@(.+?)@@/',
					array($this, 'ifinclude'),
					$code);
						// if-include without else
			$code = preg_replace_callback('/@@ifi@@([A-Za-z0-9_]+?)=(.+?)@@(.+?)@@/',
					array($this, 'ifinclude'),
					$code);
						// if-subblock with else
			$code = preg_replace_callback('/@@ifs@@([A-Za-z0-9_]+?)=(.+?)@@([A-Za-z0-9_]+?)@@([A-Za-z0-9_]+?)@@/',
					array($this, 'ifsubblock'),
					$code);
						// if-subblock without else
			$code = preg_replace_callback('/@@ifs@@([A-Za-z0-9_]+?)=(.+?)@@([A-Za-z0-9_]+?)@@/',
					array($this, 'ifsubblock'),
					$code);
		}
	}
	/**
	 * For if-includes
	 */
	private function ifinclude($match)
	{
		@list($code, $var, $val, $if, $else) = $match; 
		if (@$this->vars[$var]==$val) return APITemplate::getTemplateCode($if); 
			else return APITemplate::getTemplateCode($else);
	}
	/**
	 * For if-subblocks
	 */
	private function ifsubblock($match)
	{
		@list($code, $var, $val, $if, $else) = $match;
		if (@$this->vars[$var]==$val) return @$this->subblocks[$if]; 
								else return @$this->subblocks[$else];
	}
	/**
	 * For var substitution
	 */
	private function pfgetvar($match)
	{
		list($code, $varname) = $match;
		return @$this->vars[$varname];
	}
	/**
	 * For inflating blocks
	 */
	private function inflateblock($match)
	{
		list($code, $name) = $match;
		$blockcode = $this->blockcodes[$name];
		$currentcode = '';
		foreach($this->blockvars[$name] as $blockdata)
		{
			$tmpcode = new TAPLTemplate('__internal__',$blockcode, $this->vars, $this->subblocks);
							// overwrite
			foreach ($blockdata as $kv => $vv) $tmpcode->setText($kv, $vv);
			$currentcode .= $tmpcode->render();
		}
		return $currentcode;
	}
}	
?>
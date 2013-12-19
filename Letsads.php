<?php
namespace samson\socialauth;

use samson\core\iModuleCompressable;

class SocialAuth extends \samson\core\Service implements iModuleCompressable
{
	protected $id = 'socialauth';

	protected $requirements = array
	(
		'Auth2'
	);
	
	public $systems = array();
	
	public $connectionHandler;
	
	public $module = 'socialauth';
	public $mail_from = 'local';
	public $mail_send = true;
	
	/**	@see iExternalModule::init() */
	public function init( array $params = array() )
	{ 
		parent::init( $params );
		
		foreach ( get_child_classes( 'samson\socialauth\SocialSystem' ) as $class ) 
		{
			$system = new $class();
			$system->socialauth = & $this;
			
			eval('$this->systems[ '.$class.'::$id ] = $system;');
			
		}	
		
		return TRUE;
	}

	function beforeCompress( & $obj = null, array & $code = null )
	{
		
	}	

	function afterCompress( & $obj = null, array & $code = null )
	{
		
	}
}
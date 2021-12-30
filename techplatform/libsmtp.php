<?php
	/**
	 * 	libsmtp
	 * 	
	 *  SMTP functionality library
	 * 
	 * @author Piotr Maślanka
	 * @package techplatform
	 *  */

/**
 * Class for simple message sending
 * @package techplatform
 * @subpackage libsmtp
 */
class SMTPSimpleSender extends LastErrorImplementation
{
	/**
	 * Contains content of message to send
	 * @var string
	 */
	public $content = '';
	/** 
	 * Contains used SMTPServer instance
	 * @var SMTPServer
	 */
	public $server = null;
	/**
	 * Constructor. Just saves the given data.
	 * @param string $from Sender's email
	 * @param string $title Message title
	 * @param string $from_name Sender's friendly name
	 */
	function __construct($from, $title, $from_name)
	{
		$this->from = $from;
		$this->title = $title;
		$this->from_name = $from_name;
	}
	/**
	 * Sends a message
	 * @param string $to recipient's email
	 * @param string $content message content
	 * @return bool success
	 */
	function send($to, $content = '')
	{
		if (!empty($content)) $this->content = $content;
		$x = new SMTPMail($this->from, $to, $this->title, $this->from_name);
		$x->setContent($this->content);
		if (!$this->server->send($x))
		{
			$this->copyLastError($this->server);
			return false;
		}
		return true;	
	}
	/** 
	 * Disconnects from server
	 * @return bool success
	 */
	function disconnect()
	{
		if (!$this->server->disconnect())
		{
			$this->copyLastError($this->server);
			return false;
		}
		return true;
	}
	/**
	 * Connect with server
	 * @param string $host host address
	 * @param string $user user name
	 * @param stirng $pass user password
	 * @return bool success
	 */
	function connect($host, $user, $pass)
	{
		$this->server = new SMTPServer($host, $user, $pass);
		if (!$this->server->connect())
		{
			$this->copyLastError($this->server);
			return false;
		}
		return true;
	}	
}

/**
 * Class of a MIME entity
 * @package techplatform
 * @subpackage libsmtp
 */
 class SMTPMimeEntity
 {
 	/**
 	 * Unencoded(SMTP) data 
 	 * @var string
 	 */
	public $data = '';
	/**
	 * MIME type
	 * @var string
	 */
	public $type = '';
	/** 
	 * SMTP encoding
	 * @var string
	 */
	public $encoding = '';
	/**
	 * Attachment name
	 * @var string
	 */
	public $atname = '';
	/** 
	 * Charset name
	 * @var string
	 */
	public $charset = '';
	/**
	 * Constructor
	 * @param string $type MIME type
	 * @param string $encoding SMTP encoding
	 */
	function __construct($type, $encoding)
	{
		$this->type = $type;
		$this->encoding = $encoding;
	}
	/**
	 * Sets attachment name
	 * @param string $param attachment name
	 */
	function setAtName($param) { $this->atname = $param; }
	/**
	 * Sets data
	 * @param string $param unencoded data
	 */
	function setData($param)   { $this->data = $param; }
	/**
	 * Sets charset
	 * @param string $charset new charset
	 */
	function setCharset($param)   { $this->charset = $param; }
	/**
	 * Returns Content-Type line in SMTP
	 * @return string Content-Type SMTP line
	 */
	function getContentTypeStr()
	{
		$rs = 'Content-Type: '.$this->type;
		if (!empty($this->atname)) $rs .= '; name="'.$this->atname.'"';
		if (!empty($this->charset)) $rs .= '; charset="'.$this->charset.'"';
		return $rs;
	}
 }
 /**
  * SMTP Server class
  * @package techplatform
  * @subpackage libsmtp
  */
 class SMTPServer extends LastErrorImplementation
 {
 	private function sendMimeEntity(SMTPMimeEntity $entity)
 	{
			$this->sock_write('MIME-Version: 1.0');
			$this->sock_write($entity->getContentTypeStr());
			if ($entity->encoding) $this->sock_write('Content-Transfer-Encoding: '.$entity->encoding);
			$this->sock_write('');
			$this->sock_write($entity->data); 		
 	}
 	private function is_response_code($code)
 	{
 		$mstr = stream_socket_recvfrom($this->connection, 4096);
 		$str = substr($mstr,0,3);
 		return ($str == $code);    
 	}
 	private function sock_write($text)
 	{
 		stream_socket_sendto($this->connection, $text."\r\n");
 	}
 	function __construct($host, $user="", $pass="")
 	{
 		$this->host = $host;
 		if (count(explode(':',$host)) == 1) $this->host = $this->host.':587';
 		$this->user = $user;
 		$this->pass = $pass;
 		$this->connected = false;
 	}
 	function connect()
    {
      $this->connection = stream_socket_client('tcp://'.$this->host);
      if ($this->connection == FALSE) 
      {
      	$this->lasterror = 'Unable to connect';
      	return false;
      }
      if (!($this->is_response_code('220')))
      {
      	$this->lasterror = 'Repcode not 220 after connection';
      	return false;
      }
      $this->sock_write("HELO ".$_SERVER['SERVER_NAME']);
      if (!($this->is_response_code('250')))
      {
      	$this->lasterror = 'Repcode not 250 after HELO';
      	return false;
      }
      $this->sock_write("AUTH PLAIN");
      if ($this->is_response_code('334'))	// AUTH_PLAIN supported
      {
		$this->sock_write(base64_encode("\000$this->user\000$this->pass"));
		if (!($this->is_response_code('235')))
		{
			$this->lasterror = 'Username/password failed';
			return false;
		}
      }
      $this->connected = true;
      return true;
    }

 	function disconnect()
 	{
	 	$this->sock_write('QUIT');
	 	$this->is_response_code('221');
		unset($this->connection);
	 	//stream_socket_shutdown($this->connection, STREAM_SHUT_RDWR);
	 	$this->connected = false;
 	}

 	function send($message)
 	{
 		$this->sock_write("MAIL FROM: <$message->from>");
		if (!($this->is_response_code('250')))
		{
			$this->lasterror = 'Repcode not 250 after MAIL FROM';
			return false;
		}
		$this->sock_write("RCPT TO: <$message->to>");
		if (!($this->is_response_code('250'))) return(2);
		$this->sock_write("DATA");
		if (!($this->is_response_code('354'))) return(3);
			
		$this->sock_write('Content-Type: multipart/mixed; boundary="==maslankasmtplib=="');
		$this->sock_write('MIME-Version: 1.0');
		$this->sock_write('From: '.$message->from_name.' <'.$message->from.'>');
	 	$this->sock_write('To: <'.$message->to.'>');
	 	$this->sock_write('Subject: '.$message->title);
	 	if (isset($message->content))
	 	{
			$this->sock_write('--==maslankasmtplib==');
			$this->sendMimeEntity($message->getMailEntity());
		}
		$atchs = $message->getAttachmentEntities();
 		foreach ($atchs as $entity)
 		{
 			$this->sock_write('--==maslankasmtplib==');
			$this->sendMimeEntity($entity);
	 	}
 		$this->sock_write('--==maslankasmtplib==--');
 		$this->sock_write('.');
 		if (!($this->is_response_code('250'))) 
		{
			$this->lasterror = 'Message not accepted; repcode not 250 after final .';
			return false;
		}
 		return true;
 	}
 
 	function __destruct()
 	{
	 	if ($this->connected) $this->disconnect();
 	}
 }
 /**
  * Single SMTP mail object
  * @package techplatform
  * @subpackage libsmtp
  */
 class SMTPMail
 {
 	function getMailEntity()
 	{
 		$x = new SMTPMimeEntity('text/plain','quoted-printable');
 		$x->setData(quoted_printable_encode($this->content));
 		$x->setCharset('utf-8');
 		return $x;
 	}
 	
 	function getAttachmentEntities()
 	{
 		$entities = array();
 		foreach ($this->attachments as $atname => $atarr)
 		{
 			list($attachment, $charset,$type) = $atarr;
 			$x = new SMTPMimeEntity('application/pdf','base64');
 			$x->setAtName($atname);
 			$x->type = $type;
  			if (!empty($charset)) $x->setCharset($charset);
  			$x->setData(base64_encode($attachment));
  			$entities[] = $x;
  		}
  		return $entities;
  	}
  	
    function __construct($from, $to, $title, $from_name = "")
    {
      $this->from = $from;
      $this->to = $to;
      $this->title = $title;
      $this->from_name = (($from_name=="") ? $from : $from_name);
      $this->attachments = array();
    }

    function setContent($content)
    {
      $this->content = $content;
    }
    
    function addAttachment($attachment,$atname='',$charset='',$type='text/plain')
    {
      $this->attachments[$atname] = array($attachment, $charset,$type);
    }  
 }
?>

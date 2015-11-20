<?php
namespace efureev;


/**
 * PHP Wrapper For Custom Console Curl
 *
 * @author efureev
 */
class CustomCurl
{
	const VERSION = '0.1';

	const DEFAULT_TIMEOUT = 30;

	private $_id = null;
	private $_baseUrl = null;
	private $_curl = null;
	private $_defaultCurl = 'curl';

	public $url = null;

	private $_cmd = '';

	public $requestHeaders = null;
	public $responseHeaders = null;
	public $rawResponseHeaders = '';
	/** @var null|string  */
	private $_response = null;
	/** @var null|array  */
	private $_rawResponse = null;


	public function __construct($base_url = null)
	{
		$this->_id = 1;
		$this->setURL($base_url);
		$this->_curl = $this->_defaultCurl;

		/*$this->setDefaultUserAgent();
		$this->setDefaultJsonDecoder();
		$this->setDefaultTimeout();
		$this->setOpt(CURLINFO_HEADER_OUT, true);
		$this->setOpt(CURLOPT_HEADERFUNCTION, array($this, 'headerCallback'));
		$this->setOpt(CURLOPT_RETURNTRANSFER, true);
		$this->headers = new CaseInsensitiveArray();*/
	}


	/**
	 * @param string $url
	 * @param array $data
	 * @return $this
	 */
	public function setURL($url, $data = array())
	{
		$this->_baseUrl = $url;
		$this->url = $this->_buildURL($url, $data);
//		$this->setOpt(CURLOPT_URL, $this->url);
		return $this;
	}

	/**
	 * @param string $path
	 * @return $this
	 */
	public function setCurl($path)
	{
		$this->_curl = $path;
		return $this;
	}

	/**
	 * @param null $url
	 * @return $this
	 * @throws \Exception
	 */
	public function request($url = null)
	{
		$this->beforeExec();
		$this->exec($url);
		$this->afterExec();
		return $this;
	}

	public function beforeExec()
	{
		$this->_buildCommand();
	}

	public function afterExec()
	{
		$this->_response = implode(PHP_EOL,$this->_rawResponse);
	}

	/**
	 * @param null $url
	 * @throws \Exception
	 */
	public function exec($url = null)
	{
		if (!empty($this->url)) {
			$cmd = $this->_finalBuildCommand($this->url);
		} else {
			if ($url !== null) {
				$cmd = $this->_finalBuildCommand($url);
			} else
				throw new \Exception ('Missing URL');
		}

		exec($cmd, $this->_rawResponse);
	}

	/**
	 * @return null|string
	 */
	public function getResponse()
	{
		return $this->_response;
	}

	/**
	 * @param bool|true $full
	 * @return string
	 */
	public function getCmd($full = true)
	{
		$this->beforeExec();
		return $full ? $this->_finalBuildCommand($this->url) : $this->_cmd;
	}

	/**
	 * @param string $url
	 * @param array $data
	 * @return string
	 */
	private function _buildURL($url, $data = array())
	{
		return $url . (empty($data) ? '' : '?' . http_build_query($data));
	}

	private function _buildCommand()
	{
		$cmd[] = $this->_curl;

		$this->_cmd = implode(' ', $cmd);


		/*
		 * $cmd.= " -d @$fname";
        $cmd.=" -H \"Content-Type: text/xml\"";

        $cmd.=" $url";

		 */
	}

	/**
	 * @param $url
	 * @return string
	 */
	private function _finalBuildCommand($url)
	{
		return $this->_cmd . ' ' . $url;
	}
}
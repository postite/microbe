<?php

class haxigniter_server_request_RequestHandlerDecorator implements haxigniter_server_request_RequestHandler{
	public function __construct($requestHandler) {
		if(!php_Boot::$skip_constructor) {
		$this->requestHandler = $requestHandler;
	}}
	public function handleRequest($controller, $url, $method, $getPostData, $requestData) {
		throw new HException("RequestHandlerDecorater.handleRequest() is an abstract method and must be overridden in a child class.");
		return null;
	}
	public $requestHandler;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->�dynamics[$m]) && is_callable($this->�dynamics[$m]))
			return call_user_func_array($this->�dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	function __toString() { return 'haxigniter.server.request.RequestHandlerDecorator'; }
}

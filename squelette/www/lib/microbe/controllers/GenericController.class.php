<?php

class microbe_controllers_GenericController implements haxigniter_server_Controller{
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->configuration = microbe_controllers_GenericController::$appConfig;
		$this->db = microbe_controllers_GenericController::$appDb;
		$this->debug = microbe_controllers_GenericController::$appDebug;
		$this->view = microbe_controllers_GenericController::$appView;
		$this->session = haxigniter_server_session_SessionObject::restore(microbe_controllers_GenericController::$appSession, _hx_qtype("config.Session"), null);
		$this->requestHandler = new haxigniter_server_request_RestHandler($this->configuration, null);
	}}
	public function log($message, $debugLevel = null) {
		$this->debug->log($message, $debugLevel);
	}
	public function trace($data, $debugLevel = null, $pos = null) {
		$this->debug->trace($data, $debugLevel, $pos);
	}
	public $debug;
	public $session;
	public $db;
	public $view;
	public $configuration;
	public $contentHandler;
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
	static $__rtti = "<class path=\"microbe.controllers.GenericController\" params=\"\">\x0A\x09<implements path=\"haxigniter.server.Controller\"/>\x0A\x09<appConfig public=\"1\" line=\"62\" static=\"1\"><c path=\"config.Config\"/></appConfig>\x0A\x09<appDb public=\"1\" static=\"1\"><c path=\"haxigniter.server.libraries.Database\"/></appDb>\x0A\x09<appSession line=\"68\" static=\"1\"><c path=\"haxigniter.server.session.FileSession\"/></appSession>\x0A\x09<appDebug public=\"1\" line=\"71\" static=\"1\"><c path=\"haxigniter.server.libraries.Debug\"/></appDebug>\x0A\x09<appView line=\"90\" static=\"1\"><c path=\"haxigniter.server.views.ErazorView\"/></appView>\x0A\x09<main public=\"1\" set=\"method\" line=\"94\" static=\"1\"><f a=\"\"><e path=\"Void\"/></f></main>\x0A\x09<requestHandler public=\"1\"><c path=\"haxigniter.server.request.RequestHandler\"/></requestHandler>\x0A\x09<contentHandler public=\"1\"><c path=\"haxigniter.server.content.ContentHandler\"/></contentHandler>\x0A\x09<configuration public=\"1\" set=\"null\"><c path=\"config.Config\"/></configuration>\x0A\x09<view public=\"1\" set=\"null\"><c path=\"haxigniter.server.views.ViewEngine\"/></view>\x0A\x09<db public=\"1\" set=\"null\"><c path=\"haxigniter.server.libraries.Database\"/></db>\x0A\x09<session public=\"1\" set=\"null\"><c path=\"config.Session\"/></session>\x0A\x09<debug public=\"1\"><c path=\"haxigniter.server.libraries.Debug\"/></debug>\x0A\x09<trace set=\"method\" line=\"145\"><f a=\"data:?debugLevel:?pos\">\x0A\x09<d/>\x0A\x09<e path=\"haxigniter.server.libraries.DebugLevel\"/>\x0A\x09<t path=\"haxe.PosInfos\"/>\x0A\x09<e path=\"Void\"/>\x0A</f></trace>\x0A\x09<log set=\"method\" line=\"150\"><f a=\"message:?debugLevel\">\x0A\x09<d/>\x0A\x09<e path=\"haxigniter.server.libraries.DebugLevel\"/>\x0A\x09<e path=\"Void\"/>\x0A</f></log>\x0A\x09<new public=\"1\" set=\"method\" line=\"125\">\x0A\x09\x09<f a=\"\"><e path=\"Void\"/></f>\x0A\x09\x09<haxe_doc>* The controllers are automatically created by haxigniter.server.Application.</haxe_doc>\x0A\x09</new>\x0A\x09<haxe_doc>* This class is the base controller, parent to all controllers in the application.\x0A * \x0A * It implements haxe.rtti.Infos because some request handlers (BasicHandler and RestHandler) \x0A * uses that info to typecast the web input from the web to the controller methods.\x0A * \x0A * NOTE: Controllers called by haXigniter can only have the starting character capitalized!\x0A *       MyController is never called, so it's excepted.</haxe_doc>\x0A\x09<meta><m n=\":rttiInfos\"/></meta>\x0A</class>";
	static $appConfig;
	static $appDb;
	static $appSession;
	static $appDebug;
	static $appView;
	static function main() {
		microbe_tools_Mytrace::setRedirection();
		if(microbe_controllers_GenericController::$appConfig->development) {
			microbe_controllers_GenericController::$appDb = new config_DevelopmentConnection();
		} else {
			microbe_controllers_GenericController::$appDb = new config_OnlineConnection();
		}
		microbe_controllers_GenericController::$appDb->debug = microbe_controllers_GenericController::$appDebug;
		haxigniter_server_Application::run(microbe_controllers_GenericController::$appConfig, null);
		if(microbe_controllers_GenericController::$appDb !== null) {
			microbe_controllers_GenericController::$appDb->close();
		}
		if(microbe_controllers_GenericController::$appSession !== null) {
			microbe_controllers_GenericController::$appSession->close();
		}
	}
	function __toString() { return 'microbe.controllers.GenericController'; }
}
microbe_controllers_GenericController::$appConfig = new config_Config(null);
microbe_controllers_GenericController::$appSession = new haxigniter_server_session_FileSession(microbe_controllers_GenericController::$appConfig->sessionPath);
microbe_controllers_GenericController::$appDebug = new haxigniter_server_libraries_Debug(microbe_controllers_GenericController::$appConfig, null, null, null);
microbe_controllers_GenericController::$appView = new haxigniter_server_views_ErazorView(microbe_controllers_GenericController::$appConfig, null, null);

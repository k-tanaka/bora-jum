<?php

/**
 * ViewAbstract
 *
 * @category   Curry
 * @package    core
 * @copyright  Copyright (c) 2011 www.curryfw.net.
 * @license    MIT License
 */
abstract class ViewAbstract extends CurryClass
{
	/**
	 * Request instance, contains request informations
	 *
	 * @var Request
	 */
	protected $_request;
	
	/**
	 * Rendering controller
	 *
	 * @var string
	 */
	protected $_renderingController;
	
	/**
	 * Rendering action
	 *
	 * @var string
	 */
	protected $_renderingAction;
	
	/**
	 * Values assigned for template
	 *
	 * @var array
	 */
	protected $_vars = array();
	
	/**
	 * Name of layout template
	 *
	 * @var string
	 */
	protected $_layout = 'default';
	
	/**
	 * Name of template
	 *
	 * @var string
	 */
	protected $_template;
	
	/**
	 * Default name of error template
	 *
	 * @var string 
	 */
	protected static $_defaultErrorTemplate = 'error';
	
	/**
	 * Name of error template
	 *
	 * @var string
	 */
	protected $_errorTemplate;
	
	/**
	 * Paths of additional Javascript file
	 *
	 * @var array
	 */
	protected $_jsFiles = array();
	
	/**
	 * Paths of additional css file
	 *
	 * @var array
	 */
	protected $_cssFiles = array();
	
	/**
	 * Whether output using a template.
	 * 
	 * @var boolean
	 */
	protected $_templateEnabled = true;
	
	/**
	 * Whether output using template with layout.
	 * 
	 * @var boolean
	 */
	protected $_layoutEnabled = true;
	
	/**
	 * Default setting of whether output using template with layout.
	 * 
	 * @var boolean
	 */
	protected static $_defaultLayoutEnabled = true;
	
	/**
	 * Whether render html.
	 * 
	 * @var boolean
	 */
	protected $_renderingEnabled = true;
	
	/**
	 * Encoding of output template
	 * 
	 * @var string 
	 */
	protected $_outputEncoding;
	
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->enableLayout(self::$_defaultLayoutEnabled);
		$this->setErrorTemplate(self::$_defaultErrorTemplate);
	}
	
	/**
	 * Overriding parent.
	 * Alias of method "set".
	 *
	 * @param string $key
	 * @param mixed 
	 * @return void
	 */
	public function __set($key, $val)
	{
		$this->set($key, $val);
	}
	
	/**
	 * Overriding parent.
	 * Alias of method "get".
	 *
	 * @param string $key
	 * @return mixed 
	 */
	public function __get($key)
	{
		return $this->get($key);
	}

	/**
	 * Set value for template
	 *
	 * @param string $key
	 * @param mixed 
	 * @return void
	 */
	public function set($key, $val)
	{
		$this->_vars[$key] = $val;
	}
	
	/**
	 * Get value for template
	 *
	 * @param string $key
	 * @return mixed 
	 */
	public function get($key = null)
	{
		$ret = null;
		if ($key == null) {
			$ret = $this->_vars;
		} else if (isset($this->_vars[$key])) {
			$ret = $this->_vars[$key];
		}		
		return $ret;
	}
		
	/**
	 * Set path of template directory
	 *
	 * @param string $dir
	 * @return void
	 */
	public function setTemplateDirectory($dir)
	{
		PathManager::setViewTemplateDirectory($dir);
	}
			
	/**
	 * Set path of layout template directory
	 *
	 * @param string $dir
	 * @return void
	 */
	public function setLayoutDirectory($dir)
	{
		PathManager::setViewLayoutDirectory($dir);
	}
	
	/**
	 * Set whether render html.
	 * 
	 * @param booelan $enabled
	 * @return void
	 */
	public function enableRendering($enabled)
	{
		$this->_renderingEnabled = $enabled;
	}
	
	/**
	 * Get whether render html.
	 * 
	 * @return boolean
	 */
	public function getRenderingEnabled()
	{
		return $this->_renderingEnabled;  
	}

	/**
	 * Set layout enabled.
	 * 
	 * @param booelan $enabled
	 * @return void
	 */
	public static function setDefaultLayoutEnabled($enabled)
	{
		self::$_defaultLayoutEnabled = $enabled;
	}
	
	/**
	 * Set whether output using a template.
	 * 
	 * @param booelan $enabled
	 * @return void
	 */
	public function enableTemplate($enabled)
	{
		$this->_templateEnabled = $enabled;
	}
	
	/**
	 * Set whether output using template with layout.
	 * 
	 * @param booelan $enabled
	 * @return void
	 */
	public function enableLayout($enabled)
	{
		$this->_layoutEnabled = $enabled;
	}
	
	/**
	 * Set request instance
	 *
	 * @param Request $request Request instance
	 * @return void
	 */
	public function setRequest(Request $request)
	{
		$this->_request = $request;
	}
	
	/**
	 * Set view template use for rendering.
	 *
	 * @param string $action Action name as template file name
	 * @param string $controller Controller name as template directory name
	 * @return void
	 */
	public function setTemplate($action, $controller = null)
	{
		$req = $this->_request;
		if ($controller == null) {
			$controller = $req->getController();
			if ($req->getControllerSubDirectory()) {
				$controller = $req->getControllerSubDirectory() . '/' . $controller;
			}
		}
		$ext = NameManager::getTemplateExtension();
		$action = preg_replace('/\.' . $ext . '$/', '', $action);
		$this->_template = sprintf('%s/%s', $controller, $action);
	}
	
	/**
	 * Execute initial process,
	 *
	 * @return void
	 */
	public function initialize()
	{
		$req = $this->_request;		
		if ($req->isXmlHttp()) {
			$this->enableLayout(false);
		}
		$controller = $req->getController();
		$subdir = $req->getControllerSubDirectory();
		if ($subdir != '') {
			$controller = $subdir . '/' . $controller;
		}
		$this->_renderingController = $controller;
		$this->_renderingAction = $req->getAction();
	}
	
	/**
	 * Set controller for rendering.
	 *
	 * @param string $controller Controller name as template directory name
	 * @return void
	 */
	public function setRenderingController($controller)
	{
		$this->_renderingController = $controller;
	}
	
	/**
	 * Set action for rendering.
	 *
	 * @param string $action Action name as template file name
	 * @return void
	 */
	public function setRenderingAction($action)
	{
		$this->_renderingAction = $action;
	}
	
	/**
	 * Set default view template use for rendering on error.
	 * 
	 * @param string $tamplateName
	 * @return void
	 */
	public static function setDefaultErrorTemplate($tamplateName)
	{
		self::$_defaultErrorTemplate = $tamplateName;
	}
	
	/**
	 * Set view template use for rendering on error.
	 *
	 * @param string $tamplateName Template file name
	 * @return void
	 */
	public function setErrorTemplate($tamplateName)
	{
		$this->_errorTemplate = $tamplateName;
	}
	
	/**
	 * Get view template use for rendering on error.
	 *
	 * @return string Template file name
	 */
	public function getErrorTemplate()
	{
		return $this->_errorTemplate;
	}
	
	/**
	 * Get whether exists view template.
	 *
	 * @return boolean
	 */
	public function existsTemplate()
	{
		$ext = NameManager::getTemplateExtension();
		$templateDir = PathManager::getViewTemplateDirectory();
		$template = $this->_template . '.' . $ext;
		$templatePath = $templateDir . '/' . $template;
		$exists = file_exists($templatePath);
		return $exists;		
	}
		
	/**
	 * Set layout template
	 *
	 * @param string $layout Layout template name
	 * @return void
	 */
	public function setLayout($layout)
	{
		$ext = NameManager::getTemplateExtension();
		$layout = preg_replace('/\.' . $ext . '$/', '', $layout);
		$this->_layout = $layout;
	}
	
	/**
	 * Set encoding of output template
	 * 
	 * @param string $encoding
	 */
	public function setOutputEncoding($encoding)
	{
		$this->_outputEncoding = $encoding;
	}
	
	/**
	 * Add javascript file name to read
	 *
	 * @param string $fileName Javascript file name
	 * @param string $key Array key, if you want specify by key in template
	 * @return void
	 */
	public function addJs($fileName, $key = null)
	{
		$fileName = trim($fileName, '/');
		$fileName = preg_replace('|.js$|', '', $fileName) . '.js';
		if (!file_exists(sprintf('%s/js/%s', PathManager::getHtdocsDirectory(), $fileName))) {
			return;
		}
		if (in_array($fileName, $this->_jsFiles)) {
			return;
		}
		if ($key == null) {
			$this->_jsFiles[] = $fileName;
		} else {
			$this->_jsFiles[$key] = $fileName;
		}
	}
	
	/**
	 * Add stylesheet file name to read
	 *
	 * @param string $fileName Stylesheet file name
	 * @param string $key Array key, if you want specify by key in template
	 * @return void
	 */
	public function addCss($fileName, $key = null)
	{
		$fileName = trim($fileName, '/');
		$fileName = preg_replace('|.css$|', '', $fileName) . '.css';
		if (!file_exists(sprintf('%s/css/%s', PathManager::getHtdocsDirectory(), $fileName))) {
			return;
		}
		if (in_array($fileName, $this->_cssFiles)) {
			return;
		}
		if ($key == null) {
			$this->_cssFiles[] = $fileName;
		} else {
			$this->_cssFiles[$key] = $fileName;
		}
	}
 
	/**
	 * Clear all assigned values
	 *
	 * @return void
	 */
	public function clearValues()
	{
		$this->_vars = array();
	}
	
	/**
	 * Set basic vars to template
	 * 
	 * @return void
	 */
	public function setBasicVars()
	{
		$req = $this->_request;		
		$requestInfo['base_path']  = rtrim('/' . trim($req->getBasePath(), '/'), '/');
		$requestInfo['base_url'] = $req->getBaseUrl();
		$requestInfo['controller'] = $req->getController();
		$requestInfo['action'] = $req->getAction(); 
		$this->set('request', $requestInfo);
		
		$rendering['controller'] = $this->_renderingController;
		$rendering['action'] = $this->_renderingAction;
		$this->set('rendering', $rendering);
		
		$this->addCss('common');
		$this->addCss($this->_renderingController);
		$this->set('stylesheets', $this->_cssFiles);
		
		$this->addJs('common');
		$this->addJs($this->_renderingController);
		$this->set('javascripts', $this->_jsFiles);		
	}
	
	/**
	 * Execute output html
	 *
	 * @return void
	 */
	public function render()
	{
		if ($this->_renderingEnabled == false || $this->_templateEnabled == false) {
			return;
		}
		if ($this->_template == null) {
			$this->setTemplate($this->_renderingAction, $this->_renderingController);
		}
		$rendered = $this->getRendered();
		echo $rendered;
	}
	
	/**
	 * Get output text which should be outputted is acquired. 
	 * 
	 * @return string
	 */
	public function getRendered()
	{
		$this->setBasicVars();
		$wasNull = false;
		if ($this->_template == null) {
			$wasNull = true;
			$this->setTemplate($this->_renderingAction, $this->_renderingController);
		}
		$rendered = null;
		if ($this->_layoutEnabled) {
			$rendered = $this->renderTemplateWithLayout();
		} else {
			$rendered = $this->renderTemplate();
		}
		if ($wasNull == true) {
			$this->_template = null;
		}
		if ($rendered != '' && $this->_outputEncoding != null) {
			$currentEnc = mb_detect_encoding($rendered);
			if ($currentEnc != $this->_outputEncoding) {
				$rendered = mb_convert_encoding($rendered, $this->_outputEncoding, $currentEnc);
			}
		}
		return $rendered;
	}
		
	/**
	 * Execute output html using a layout template
	 *
	 * @return void
	 */
	abstract protected function renderTemplate();
	
	/**
	 * Execute output html without using a layout template
	 *
	 * @return void
	 */
	abstract protected function renderTemplateWithLayout();
		
}
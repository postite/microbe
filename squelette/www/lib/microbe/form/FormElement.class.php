<?php

class microbe_form_FormElement {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->active = true;
		$this->errors = new HList();
		$this->validators = new HList();
		$this->inited = false;
	}}
	public $form;
	public $name;
	public $label;
	public $description;
	public $value;
	public $required;
	public $errors;
	public $attributes;
	public $active;
	public $validators;
	public $cssClass;
	public $inited;
	public function isValid() {
		$this->errors->clear();
		if($this->active === false) {
			return true;
		}
		if(_hx_equal($this->value, "") && $this->required) {
			$this->errors->add("<span class=\"formErrorsField\">" . (microbe_form_FormElement_0($this)) . "</span> required.");
			return false;
		} else {
			if(!_hx_equal($this->value, "")) {
				if(!$this->validators->isEmpty()) {
					$pass = true;
					if(null == $this->validators) throw new HException('null iterable');
					$�it = $this->validators->iterator();
					while($�it->hasNext()) {
						$validator = $�it->next();
						if(!$validator->isValid($this->value)) {
							$pass = false;
						}
					}
					if(!$pass) {
						return false;
					}
				}
				return true;
			}
		}
		return true;
	}
	public function checkValid() {
		_hx_equal($this->value, "");
	}
	public function init() {
		$this->inited = true;
	}
	public function addValidator($validator) {
		$this->validators->add($validator);
	}
	public function bindEvent($event, $method, $params, $isMethodGlobal) {
		if($isMethodGlobal === null) {
			$isMethodGlobal = false;
		}
	}
	public function populate() {
		if(!$this->inited) {
			$this->init();
		}
		$n = $this->form->name . "_" . $this->name;
		$v = php_Web::getParams()->get($n);
		haxe_Log::trace("v=" . php_Web::getParams(), _hx_anonymous(array("fileName" => "FormElement.hx", "lineNumber" => 129, "className" => "microbe.form.FormElement", "methodName" => "populate")));
		if($v !== null) {
			$this->value = $v;
		}
	}
	public function getErrors() {
		$this->isValid();
		if(null == $this->validators) throw new HException('null iterable');
		$�it = $this->validators->iterator();
		while($�it->hasNext()) {
			$val = $�it->next();
			if(null == $val->errors) throw new HException('null iterable');
			$�it2 = $val->errors->iterator();
			while($�it2->hasNext()) {
				$err = $�it2->next();
				$this->errors->add("<span class=\"formErrorsField\">" . $this->label . "</span> : " . $err);
			}
		}
		return $this->errors;
	}
	public function render($iter) {
		if(!$this->inited) {
			$this->init();
		}
		return $this->value;
	}
	public function remove() {
		if($this->form !== null) {
			return $this->form->removeElement($this);
		}
		return false;
	}
	public function getPreview() {
		return "<li><span>" . $this->getLabel() . "</span><div>" . $this->render(null) . "</div></li>";
	}
	public function getType() {
		return Std::string(Type::getClass($this));
	}
	public function getLabelClasses() {
		$css = "";
		$requiredSet = false;
		if($this->required) {
			$css = $this->form->requiredClass;
			if($this->form->isSubmitted() && $this->required && _hx_equal($this->value, "")) {
				$css = $this->form->requiredErrorClass;
				$requiredSet = true;
			}
		}
		if(!$requiredSet && $this->form->isSubmitted() && !$this->isValid()) {
			$css = $this->form->invalidErrorClass;
		}
		if($this->cssClass !== null) {
			$css .= microbe_form_FormElement_1($this, $css, $requiredSet);
		}
		return $css;
	}
	public function getLabel() {
		$n = $this->form->name . "_" . $this->name;
		return "<label for=\"" . $n . "\" class=\"" . $this->getLabelClasses() . "\" id=\"" . $n . "Label\">" . $this->label . (microbe_form_FormElement_2($this, $n)) . "</label>";
	}
	public function getClasses() {
		$css = microbe_form_FormElement_3($this);
		if($this->required && $this->form->isSubmitted()) {
			if(_hx_equal($this->value, "")) {
				$css .= " " . $this->form->requiredErrorClass;
			}
			if(!$this->isValid()) {
				$css .= " " . $this->form->invalidErrorClass;
			}
		}
		return trim($css);
	}
	public function test() {
		$this->init();
		return "popoop" . $this->form->name;
	}
	public function safeString($s) {
		return (($s === null) ? "" : _hx_explode("\"", StringTools::htmlEscape(Std::string($s)))->join("&quot;"));
	}
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
	function __toString() { return 'microbe.form.FormElement'; }
}
function microbe_form_FormElement_0(&$�this) {
	if($�this->label !== null && $�this->label !== "") {
		return $�this->label;
	} else {
		return $�this->name;
	}
}
function microbe_form_FormElement_1(&$�this, &$css, &$requiredSet) {
	if($css === "") {
		return $�this->cssClass;
	} else {
		return " " . $�this->cssClass;
	}
}
function microbe_form_FormElement_2(&$�this, &$n) {
	if($�this->required) {
		return $�this->form->labelRequiredIndicator;
	}
}
function microbe_form_FormElement_3(&$�this) {
	if($�this->cssClass !== null) {
		return $�this->cssClass;
	} else {
		return $�this->form->defaultClass;
	}
}
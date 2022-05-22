<?php

namespace Endsides\Test;

use Endsides\Html\Attribute;

class HtmlAttributeTester extends Tester {
	protected Attribute $attribute;

	public function __construct() {
		parent::__construct('Html\\Attribute');
		$this->attribute = new Attribute('style', 'color: red;');
	}

	public function testAttributeName(): self {
		$this->assert('style' === $this->attribute->getName(), 'Name');
		return $this;
	}

	public function testAttributeValue(): self {
		$this->assert('color: red;' === $this->attribute->getValue(), 'Value');
		return $this;
	}

	public function test(): self {
		return $this->testAttributeName()->testAttributeValue();
	}
}
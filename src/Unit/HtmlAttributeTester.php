<?php

namespace Endsides\Unit;

use Endsides\Common\Tester;
use Endsides\Html\Attribute;
use Endsides\Util\Html;

class HtmlAttributeTester extends Tester {
	protected Attribute $attribute;

	public function __construct() {
		parent::__construct(Attribute::class);
		$this->attribute = Html::attribute('style', 'color: red;');
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

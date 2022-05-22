<?php

namespace Endsides\Unit;

use Endsides\Util\Css;
use Endsides\Common\Tester;

class CssDeclarationTester extends Tester {
	protected $declaration;

	public function __construct() {
		parent::__construct(Declaration::class);
		$this->declaration = Css::declaration('color', 'red', true);
	}

	public function testProperty(): self {
		$this->assert($this->declaration->getProperty()->nameIs('color'), 'Property');
		return $this;
	}

	public function testValue(): self {
		$this->assert('red' === $this->declaration->getValue(), 'Value');
		return $this;
	}

	public function testImportance(): self {
		$this->assert($this->declaration->isImportant(), 'Importance');
		return $this;
	}

	public function test(): self {
		return $this->testProperty()->testValue()->testImportance();
	}
}

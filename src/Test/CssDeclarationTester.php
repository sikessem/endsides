<?php

namespace Endsides\Test;

use Endsides\Css\Declaration;

class CssDeclarationTester extends Tester {
	protected $declaration;

	public function __construct() {
		parent::__construct('Css\\Declaration');
		$this->declaration = new Declaration('color', 'red', true);
	}

	public function testProperty(): self {
		$this->assert($this->declaration->getProperty() === 'color', 'Property');
		return $this;
	}

	public function testValue(): self {
		$this->assert($this->declaration->getValue() === 'red', 'Value');
		return $this;
	}

	public function testImportance(): self {
		$this->assert($this->declaration->isImportant(), 'Important');
		return $this;
	}

	public function test(): self {
		return $this->testProperty()->testValue()->testImportance();
	}
}

<?php

namespace Endsides\Test;

use Endsides\Css\Selector;

class CssSelectorTester extends Tester {
	protected $selector;

	public function __construct() {
		parent::__construct(Selector::class);
		$this->selector = new Selector('#foo');
	}

	public function testPattern(): self {
		$this->assert($this->selector->patternMatches('#foo'), 'Pattern');
		return $this;
	}

	public function test(): self {
		return $this->testPattern();
	}
}

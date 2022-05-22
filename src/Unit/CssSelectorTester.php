<?php

namespace Endsides\Unit;

use Endsides\Util\Css;
use Endsides\Common\Tester;

class CssSelectorTester extends Tester {
	protected $selector;

	public function __construct() {
		parent::__construct(Selector::class);
		$this->selector = Css::selector('#foo');
	}

	public function testPattern(): self {
		$this->assert($this->selector->patternMatches('#foo'), 'Pattern');
		return $this;
	}

	public function test(): self {
		return $this->testPattern();
	}
}

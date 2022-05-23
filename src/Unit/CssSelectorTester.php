<?php

namespace Endsides\Unit;

use Endsides\Common\Tester;
use Endsides\Css\Selector;
use Endsides\Util\Css;

class CssSelectorTester extends Tester {
	protected Selector $selector;

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

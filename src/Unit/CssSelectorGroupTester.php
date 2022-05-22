<?php

namespace Endsides\Unit;

use Endsides\Util\Css;
use Endsides\Common\Tester;

class CssSelectorGroupTester extends Tester {
	protected $selectorGroup;

	public function __construct() {
		parent::__construct(SelectorGroup::class);
		$this->selectorGroup = Css::selectorGroup(...[
			Css::selector('#foo'),
			Css::selector('.bar'),
			Css::selector('baz'),
		]);
	}

	public function testGetSelectors(): self {
		$this->assert($this->selectorGroup->getSelectors(['#foo', '.bar']) == [
			Css::selector('#foo'),
			Css::selector('.bar'),
		], 'GetSelectors');
		return $this;
	}

	public function testRemoveSelectors(): self {
		$this->selectorGroup->removeSelectors(['#foo', '.bar']);
		$this->assert($this->selectorGroup->getSelectors() == [
			Css::selector('baz'),
		], 'RemoveSelectors');
		return $this;
	}

	public function test(): self {
		return $this->testGetSelectors()->testRemoveSelectors();
	}
}

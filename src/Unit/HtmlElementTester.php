<?php

namespace Endsides\Unit;

use Endsides\Common\Tester;
use Endsides\Html\Element;
use Endsides\Util\Html;

class HtmlElementTester extends Tester {
	protected Element $element;

	public function __construct() {
		parent::__construct(Element::class);
		$this->element = new Element('div', [Html::attribute('class', 'test')], ...[
			Html::element('span', [Html::attribute('id', 'hello')], Html::text('Hello')),
		]);
	}

	public function testName(): self {
		$this->assert($this->element->nameIs('div'), 'Name');
		return $this;
	}

	public function testGetAttribute(): self {
		$this->assert($this->element->getAttribute('class') == Html::attribute('class', 'test'), 'GetAttribute');
		return $this;
	}

	public function testGetAttributes(): self {
		$this->assert($this->element->getAttributes() == [Html::attribute('class', 'test')], 'GetAttributes');
		return $this;
	}

	public function testHasAttribute(): self {
		$this->assert($this->element->hasAttribute('class'), 'HasAttribute');
		return $this;
	}

	public function testNodes(): self {
		$this->assert($this->element->hasNodes() && $this->element->getNodes()[0]->nameIs('span'), 'Nodes');
		return $this;
	}

	public function test(): self {
		return $this->testName()->testGetAttribute()->testGetAttributes()->testHasAttribute()->testNodes();
	}
}

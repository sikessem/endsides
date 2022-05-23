<?php

namespace Endsides\Unit;

use Endsides\Util\Html;
use Endsides\Common\Tester;

class HtmlAttributeListTester extends Tester {
	protected $attributeList;

	public function __construct() {
		parent::__construct(AttributeGroup::class);
		$this->attributeList = Html::attributeList(...[
			Html::attribute('class', 'foo'),
			Html::attribute('id', 'bar'),
			Html::attribute('data-foo', 'baz'),
		]);
	}

	public function testGetAttributes(): self {
		$this->assert($this->attributeList->getAttributes(['class', 'id']) == [
			Html::attribute('class', 'foo'),
			Html::attribute('id', 'bar'),
		], 'GetAttributes');
		return $this;
	}

	public function testRemoveAttributes(): self {
		$this->attributeList->removeAttributes(['class', 'id']);
		$this->assert($this->attributeList->getAttributes() == [
			Html::attribute('data-foo', 'baz'),
		], 'RemoveAttributes');
		return $this;
	}

	public function test(): self {
		return $this->testGetAttributes()->testRemoveAttributes();
	}
}

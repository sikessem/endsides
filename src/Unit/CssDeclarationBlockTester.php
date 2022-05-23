<?php

namespace Endsides\Unit;

use Endsides\Common\Tester;
use Endsides\Css\DeclarationBlock;
use Endsides\Util\Css;

class CssDeclarationBlockTester extends Tester {
	protected DeclarationBlock $declarationBlock;

	public function __construct() {
		parent::__construct(DeclarationBlock::class);
		$this->declarationBlock = Css::declarationBlock(...[
			Css::declaration('color', 'red'),
			Css::declaration('font-size', '12px'),
			Css::declaration('font-weight', 'bold'),
		]);
	}

	public function testGetDeclarations(): self {
		$this->assert($this->declarationBlock->getDeclarations(['color', 'font-size']) == [
			Css::declaration('color', 'red'),
			Css::declaration('font-size', '12px'),
		], 'GetDeclarations');
		return $this;
	}

	public function testRemoveDeclarations(): self {
		$this->declarationBlock->removeDeclarations(['color', 'font-size']);
		$this->assert($this->declarationBlock->getDeclarations() == [
			Css::declaration('font-weight', 'bold'),
		], 'RemoveDeclarations');
		return $this;
	}

	public function test(): self {
		return $this->testGetDeclarations()->testRemoveDeclarations();
	}
}

<?php

namespace Endsides\Test;

use Endsides\Css\DeclarationBlock;
use Endsides\Css\Declaration;

class CssDeclarationBlockTester extends Tester {
	protected DeclarationBlock $declarationBlock;

	public function __construct() {
		parent::__construct(DeclarationBlock::class);
		$this->declarationBlock = new DeclarationBlock(...[
			new Declaration('color', 'red'),
			new Declaration('font-size', '12px'),
			new Declaration('font-weight', 'bold'),
		]);
	}

	public function testGetDeclarations(): self {
		$this->assert($this->declarationBlock->getDeclarations(['color', 'font-size']) == [
			new Declaration('color', 'red'),
			new Declaration('font-size', '12px'),
		], 'GetDeclarations');
		return $this;
	}

	public function testRemoveDeclarations(): self {
		$this->declarationBlock->removeDeclarations(['color', 'font-size']);
		$this->assert($this->declarationBlock->getDeclarations() == [
			new Declaration('font-weight', 'bold'),
		], 'RemoveDeclarations');
		return $this;
	}

	public function test(): self {
		return $this->testGetDeclarations()->testRemoveDeclarations();
	}
}

<?php

namespace Endsides\Html;

use Endsides\Common\{
	Trait\Value,
	Interface\Valuable,
};

class Text extends Node implements Valuable {
	use Value;

	public function __construct(string $value) {
		parent::__construct('text');
		$this->setValue($value);
	}
}

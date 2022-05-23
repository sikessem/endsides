<?php

namespace Endsides\Html;

use Endsides\Common\{
	Interface\Nameable,
	Trait\Name,
	Interface\Valuable,
	Trait\Value,
};

class Attribute implements Nameable, Valuable {
	use Name, Value;

	public function __construct(string $name, mixed $value = null) {
		$this->setName($name);
		$this->setValue($value);
	}
}

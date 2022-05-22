<?php

namespace Endsides\Html;

use Endsides\Common\Trait\Name;

class Attribute {
	use Name;

	public function __construct(string $name, string $value) {
		$this->setName($name);
		$this->setValue($value);
	}

	protected string $value = '';

	public function setValue(string $value): self {
		$this->value = $value;
		return $this;
	}

	public function getValue(): string {
		return $this->value;
	}
}

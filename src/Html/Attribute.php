<?php

namespace Endsides\Html;

class Attribute {
	public function __construct(string $name, string $value) {
		$this->setName($name);
		$this->setValue($value);
	}

	protected string $name = '';

	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}

	public function getName(): string {
		return $this->name;
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

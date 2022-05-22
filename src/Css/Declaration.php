<?php

namespace Endsides\Css;

class Declaration {
	public function __construct(string|Property $property, int|string $value, bool $important = false) {
		$this->setProperty($property);
		$this->setValue($value);
		$this->setImportance($important);
	}

	protected Property $property;

	public function setProperty(string|Property $property): self {
		$this->property = $property instanceof Property ? $property : new Property($property);
		return $this;
	}

	public function getProperty(): Property {
		return $this->property;
	}

	protected int|string $value;

	public function setValue(int|string $value): self {
		$this->value = $value;
		return $this;
	}

	public function getValue(): int|string {
		return $this->value;
	}

	protected bool $important;

	public function setImportance(bool $important): self {
		$this->important = $important;
		return $this;
	}

	public function isImportant(): bool {
		return $this->important;
	}
}

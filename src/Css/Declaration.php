<?php

namespace Endsides\Css;

use Endsides\Common\{
	Interface\Valuable,
	Trait\Value,
};

class Declaration implements Valuable {
	use Value;

	public function __construct(string|Property $property, mixed $value = null, bool $important = false) {
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

	protected bool $important;

	public function setImportance(bool $important): self {
		$this->important = $important;
		return $this;
	}

	public function isImportant(): bool {
		return $this->important;
	}
}

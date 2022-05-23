<?php

namespace Endsides\Html;

class Node {
	public function __construct(string $type) {
		$this->setType($type);
	}

	protected string $type;

	public function setType(string $type): self {
		$this->type = $type;
		return $this;
	}

	public function getType(): string {
		return $this->type;
	}
}

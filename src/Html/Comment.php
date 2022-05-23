<?php

namespace Endsides\Html;

class Comment extends Node implements Valuable {
	use Value;

	public function __construct(string $value) {
		parent::__construct('comment');
		$this->setValue($value);
	}
}

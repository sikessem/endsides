<?php

namespace Endsides\Css;

use Endsides\Common\Trait\Name;

class Property {
	use Name;

	public function __construct(string $name) {
		$this->setName($name);
	}
}

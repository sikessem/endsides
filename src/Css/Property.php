<?php

namespace Endsides\Css;

use Endsides\Common\{
	Interface\Nameable,
	Trait\Name,
};

class Property implements Nameable {
	use Name;

	public function __construct(string $name) {
		$this->setName($name);
	}
}

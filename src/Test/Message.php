<?php

namespace Endsides\Test;

class Message {
	const FAILURE = 'failure';
	const SUCCESS = 'success';
	const WARNING = 'warning';
	const NOTE = 'note';
	const QUESTION = 'question';
	const DEBUG = 'debug';

	public function __construct(string $type, string $content) {
		$this->setType($type)->setContent($content);
	}

	protected string $type;

	public function setType(string $type): self {
		$this->type = $type;
		return $this;
	}

	public function getType(): string {
		return $this->type;
	}

	protected string $content;

	public function setContent(string $content): self {
		$this->content = $content;
		return $this;
	}

	public function getContent(): string {
		return $this->content;
	}

	public function output() {
		switch($this->getType()) {
			case self::FAILURE:
				return "\033[1;31m ✘ {$this->getContent()}\033[0m";
			case 'success':
				return "\033[1;32m ✔ {$this->getContent()}\033[0m";
			case 'warning':
				return "\033[1;33m ⚠ {$this->getContent()}\033[0m";
			case 'note':
				return "\033[1;34m ℹ {$this->getContent()}\033[0m";
			case 'question':
				return "\033[1;35m ❓ {$this->getContent()}\033[0m";
			case 'debug':
				return "\033[1;36m ⚙ {$this->getContent()}\033[0m";
			default:
				return $this->getContent();
		}
	}

	public function __toString(): string {
		return $this->output();
	}
}

<?php

namespace Endsides;

class Application {
	public function __construct(string $name, string $root, string $base = '/', string|array $indexes = ['index', 'home'], string|array $extensions = ['php', 'html', 'css']) {
		$this->setName($name);
		$this->setRoot($root);
		$this->setBase($base);
		$this->setIndexes((array) $indexes);
		$this->setExtensions((array) $extensions);
	}

	protected string $name;

	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}

	public function getName(): string {
		return $this->name;
	}

	protected string $root;

	public function setRoot(string $root): self {
		$this->root = $root;
		return $this;
	}

	public function getRoot(): string {
		return $this->root;
	}

	protected string $base;

	public function setBase(string $base): self {
		$this->base = $base;
		return $this;
	}

	public function getBase(): string {
		return $this->base;
	}

	protected array $indexes = [];

	public function resetIndexes(): self {
		$this->indexes = [];
		return $this;
	}

	public function setIndexes(array $indexes): self {
		$this->resetIndexes();
		return $this->addIndexes($indexes);
	}

	public function addIndexes(array $indexes): self {
		foreach ($indexes as $index) {
			$this->addIndex($index);
		}
		return $this;
	}

	public function addIndex(string $index): self {
		if (!in_array($index, $this->indexes)) {
			$this->indexes[] = $index;
		}
		return $this;
	}

	public function getIndexes(): array {
		return empty($this->indexes) ? ['index'] : $this->indexes;
	}

	public function getIndex(string $path): string {
		foreach ($this->getIndexes() as $index) {
			if (is_file($file = $path . DIRECTORY_SEPARATOR . $index) || is_file($file = $this->getExtension($file))) {
				return $file;
			}
		}
		return $path;
	}

	protected array $extensions = [];

	public function resetExtensions(): self {
		$this->extensions = [];
		return $this;
	}

	public function setExtensions(array $extensions): self {
		$this->resetExtensions();
		return $this->addExtensions($extensions);
	}

	public function addExtensions(array $extensions): self {
		foreach ($extensions as $extension) {
			$this->addExtension($extension);
		}
		return $this;
	}

	public function addExtension(string $extension): self {
		if (!in_array($extension, $this->extensions)) {
			$this->extensions[] = str_starts_with('.', $extension) ? $extension : ".$extension";
		}
		return $this;
	}

	public function getExtensions(): array {
		return empty($this->extensions) ? ['.php'] : $this->extensions;
	}

	protected array $actions = [];

	public function on(string|array $method, string $pattern, callable $callback): self {
		$methods = (array) $method;
		foreach ($methods as $method) {
			$this->add($method, $pattern, $callback);
		}
		return $this;
	}

	public function add(string $method, string $pattern, callable $callback): self {
		$verbs = preg_split('/[^a-zA-Z]+/', $method, PREG_SPLIT_NO_EMPTY);
		foreach($verbs as $verb) {
			$verb = strtoupper($verb);
			$this->actions[$verb][$pattern] = $callback;
		}
		return $this;
	}

	public function do(string $method, string $uri, array $args = []): mixed {
		$path = parse_url($uri, PHP_URL_PATH);
		$path = preg_replace('/\/+/', '/', $path);
		$path = $this->base . $path;
		$path = trim($path, '/');
		foreach ($this->actions[$method] ?? [] as $pattern => $action) {
			$pattern = trim($pattern, '/');
			if (preg_match("/^$pattern$/", $path, $match)) {
				$result = $action($args);
				if (is_string($result)) {
					echo $result;
					return 200;
				}
				return $result;
			}
		}
		return $this->getPage($path, $method, $args);
	}

	protected string $base = '';

	public function connect(string $name): self {
		if (preg_match('/^(?P<base>(?:.*\.)*)' . preg_quote($this->getName(), '/') . '$/', $name, $matches)) {
			$base = $matches['base'];
			$base = str_replace('.', '/', $base);
			$this->base = $base;
		}
		return $this;
	}

	public function getPage(string $path, string $method, array $args): mixed {
		if (file_exists($file = $this->getRoot() . DIRECTORY_SEPARATOR . $path)) {
			if (is_dir($file)) {
				$file = $this->getIndex($file);
			}
		}

		if (is_file($file) || is_file($file = $this->getExtension($file))) {
			return $this->readFile($file, $args);
		}

		return $this->getError($path, $method, $args);
	}

	public function getError(string $path, string $method, array $args = []) {
		http_response_code(404);
		echo "<p>Document <b>$path</b> not found</p>";
		exit(1);
	}

	public function getExtension(string $path): string {
		foreach ($this->getExtensions() as $extension) {
			if (is_file($file = $path . $extension)) {
				return $file;
			}
		}
		return $path;
	}

	public function readFile(string $file, array $args = []): string {
		if (is_file($file) && !$this->isIgnored($file)) {
			http_response_code(200);
			extract($args);
			$result = require $file;
			if (is_string($result)) {
				echo $result;
				return 200;
			}
			return $result;
		}
	}

	protected array $ignores = [
		'.*',
		'_*',
	];

	public function ignore(string $pattern): self {
		$this->ignores[] = $pattern;
		return $this;
	}

	public function isIgnored($file): bool {
		foreach ($this->ignores as $ignore) {
			if (fnmatch($ignore, $file)) {
				return true;
			}
		}
		return false;
	}
}

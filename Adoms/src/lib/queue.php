<?php

namespace Adoms\src\lib;
spl_autoload_register(function ($className)
{
	$path1 = '/Adoms/src/lib/';
	$path2 = '';

	if (file_exists($path1.$className.'.php'))
		include $path1.$className.'.php';
	else
		include $path2.$className.'.php';
});

	class Queue {

		public $queueTemp;
		public $parentType;

		public function __construct() {
			$this->rootType = 'Container';
			$this->parentType = 'Queue';
			$this->childType = 'Queue';
			$this->typeOf = 'Queue';
		}

		public function destroy() {
			$this->dat = null;
		}

		/*
		*
		* public function size
		* @parameters none
		*
		*/
		// Report Size of Container
		public function size() {
			if (sizeof($this->dat) >= 0)
				return sizeof($this->dat);
			else return -1;
		}

		/*
		*
		* public function save
		* @parameters string
		*
		*/
		public function save(string $json_name) {
			$fp = fopen("$json_name", "w");
			fwrite($fp, serialize($this));
			fclose($fp);
			return 1;
		}

		/*
		*
		* public function loadJSON
		* @parameters string
		*
		*/
		public function loadJSON(string $json_name) {
			if (file_exists("$json_name") && filesize("$json_name") > 0)
				$fp = fopen("$json_name", "r");
			else
				return 0;
			$json_context = fread($fp, filesize("$json_name"));
			$old = unserialize($json_context);
			$b = $old;
			foreach ($b as $key => $val) {
				$this->$key = $b->$key; //addModelData($old->view, array($key, $val));
			}
			return 1;
		}

		/*
		*
		* public function poll
		* @parameters none
		*
		*/
		// Remove while Retrieving entry 1
		public function poll() {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Queue');
				return 0;
			}
			$j = $this->dat[0];
			array_shift($this->dat);
			$this->setIndex($this->getIndex());
			return $j;
		}

		/*
		*
		* public function push
		* @parameters mixed
		*
		*/
		// Push on to Queue
		public function push($r) {
			return array_push($this->dat, $r);
		}

		/*
		*
		* public function pop
		* @parameters none
		*
		*/
		// Retrieve first Queue and pop
		public function pop() {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Queue');
				return 0;
			}
			array_pop($this->dat);
			$this->dat = $queueTemp;
			return 1;
		}

		/*
		*
		* public function getElement
		* @parameters none
		*
		*/
		// Return first Queue
		public function getElement() {
			if ($this->size() == 0) {
				if ($this->strict == 1) throw new IndexException('Empty Queue');
				return 0;
			}
			return $this->dat[0];
		}

		/*
		*
		* public function clear
		* @parameters none
		*
		*/
		// Empty Queue
		public function clear() {
			$this->dat = array();
			return 1;
		}
	}

?>
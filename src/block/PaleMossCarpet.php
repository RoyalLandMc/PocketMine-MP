<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\block\utils\MossCarpetSide;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\math\Facing;

use function in_array;

class PaleMossCarpet extends MossCarpet{
	/** @var array<int, MossCarpetSide> */
	protected array $sides = [];
	protected bool $upper = false;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$sides = [];
		foreach(Facing::HORIZONTAL as $facing){
			$side = $this->sides[$facing] ?? MossCarpetSide::NONE;
			$w->enum($side);
			$sides[$facing] = $side;
		}
		$this->sides = $sides;
		$w->bool($this->upper);
	}

	public function getSideState(int $facing) : MossCarpetSide{
		return $this->sides[$facing] ?? MossCarpetSide::NONE;
	}

	/** @return $this */
	public function setSideState(int $facing, MossCarpetSide $side) : self{
		if(!in_array($facing, Facing::HORIZONTAL, true)){
			throw new \InvalidArgumentException("Side must be horizontal");
		}
		$this->sides[$facing] = $side;
		return $this;
	}

	public function isUpper() : bool{ return $this->upper; }

	/** @return $this */
	public function setUpper(bool $upper) : self{
		$this->upper = $upper;
		return $this;
	}
}

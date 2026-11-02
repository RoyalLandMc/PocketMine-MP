<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\block\utils\SupportType;
use pocketmine\data\runtime\RuntimeDataDescriber;

class Scaffolding extends Transparent{
	public const MIN_STABILITY = 0;
	public const MAX_STABILITY = 7;

	protected int $stability = self::MIN_STABILITY;
	protected bool $stabilityCheck = false;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->boundedIntAuto(self::MIN_STABILITY, self::MAX_STABILITY, $this->stability);
		$w->bool($this->stabilityCheck);
	}

	public function getStability() : int{ return $this->stability; }

	/** @return $this */
	public function setStability(int $stability) : self{
		if($stability < self::MIN_STABILITY || $stability > self::MAX_STABILITY){
			throw new \InvalidArgumentException("Stability must be in range " . self::MIN_STABILITY . " ... " . self::MAX_STABILITY);
		}
		$this->stability = $stability;
		return $this;
	}

	public function isStabilityCheck() : bool{ return $this->stabilityCheck; }

	/** @return $this */
	public function setStabilityCheck(bool $stabilityCheck) : self{
		$this->stabilityCheck = $stabilityCheck;
		return $this;
	}

	public function canClimb() : bool{
		return true;
	}

	public function getSupportType(int $facing) : SupportType{
		return SupportType::NONE;
	}

	public function getFuelTime() : int{
		return 50;
	}
}

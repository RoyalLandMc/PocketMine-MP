<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\block\utils\CreakingHeartState;
use pocketmine\block\utils\PillarRotation;
use pocketmine\block\utils\PillarRotationTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;

class CreakingHeart extends Opaque implements PillarRotation{
	use PillarRotationTrait;

	protected CreakingHeartState $heartState = CreakingHeartState::UPROOTED;
	protected bool $natural = false;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->axis($this->axis);
		$w->enum($this->heartState);
		$w->bool($this->natural);
	}

	public function getHeartState() : CreakingHeartState{ return $this->heartState; }

	/** @return $this */
	public function setHeartState(CreakingHeartState $heartState) : self{
		$this->heartState = $heartState;
		return $this;
	}

	public function isNatural() : bool{ return $this->natural; }

	/** @return $this */
	public function setNatural(bool $natural) : self{
		$this->natural = $natural;
		return $this;
	}
}

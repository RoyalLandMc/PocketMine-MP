<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\block\utils\EggCrackState;
use pocketmine\block\utils\SupportType;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\math\Axis;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;

class SnifferEgg extends Transparent{
	protected EggCrackState $crackState = EggCrackState::NO_CRACKS;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->enum($this->crackState);
	}

	public function getCrackState() : EggCrackState{ return $this->crackState; }

	/** @return $this */
	public function setCrackState(EggCrackState $crackState) : self{
		$this->crackState = $crackState;
		return $this;
	}

	protected function recalculateCollisionBoxes() : array{
		return [AxisAlignedBB::one()->squash(Axis::X, 1 / 16)->squash(Axis::Z, 2 / 16)->trim(Facing::UP, 1 / 16)];
	}

	public function getSupportType(int $facing) : SupportType{
		return SupportType::NONE;
	}
}

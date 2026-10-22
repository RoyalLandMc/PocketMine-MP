<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\block\utils\StaticSupportTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\math\Facing;

class PaleHangingMoss extends Flowable{
	use StaticSupportTrait;

	protected bool $tip = true;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->bool($this->tip);
	}

	public function isTip() : bool{ return $this->tip; }

	/** @return $this */
	public function setTip(bool $tip) : self{
		$this->tip = $tip;
		return $this;
	}

	private function canBeSupportedAt(Block $block) : bool{
		$above = $block->getSide(Facing::UP);
		return $above instanceof PaleHangingMoss || $above->getSupportType(Facing::DOWN)->hasCenterSupport();
	}
}

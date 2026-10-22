<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\block\utils\SeagrassType;
use pocketmine\block\utils\StaticSupportTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\math\Facing;

class Seagrass extends Flowable{
	use StaticSupportTrait;

	protected SeagrassType $seagrassType = SeagrassType::DEFAULT;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->enum($this->seagrassType);
	}

	public function getSeagrassType() : SeagrassType{ return $this->seagrassType; }

	/** @return $this */
	public function setSeagrassType(SeagrassType $seagrassType) : self{
		$this->seagrassType = $seagrassType;
		return $this;
	}

	private function canBeSupportedAt(Block $block) : bool{
		$below = $block->getSide(Facing::DOWN);
		if($this->seagrassType === SeagrassType::DOUBLE_TOP){
			return $below instanceof Seagrass && $below->seagrassType === SeagrassType::DOUBLE_BOT;
		}
		return $below->getSupportType(Facing::UP)->hasCenterSupport();
	}
}

<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\block\utils\StaticSupportTrait;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\math\Facing;

class Kelp extends Flowable{
	use StaticSupportTrait;

	public const MIN_AGE = 0;
	public const MAX_AGE = 25;

	protected int $age = self::MIN_AGE;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->boundedIntAuto(self::MIN_AGE, self::MAX_AGE, $this->age);
	}

	public function getAge() : int{ return $this->age; }

	/** @return $this */
	public function setAge(int $age) : self{
		if($age < self::MIN_AGE || $age > self::MAX_AGE){
			throw new \InvalidArgumentException("Age must be in range " . self::MIN_AGE . " ... " . self::MAX_AGE);
		}
		$this->age = $age;
		return $this;
	}

	private function canBeSupportedAt(Block $block) : bool{
		$below = $block->getSide(Facing::DOWN);
		return $below instanceof Kelp || $below->getSupportType(Facing::UP)->hasCenterSupport();
	}
}

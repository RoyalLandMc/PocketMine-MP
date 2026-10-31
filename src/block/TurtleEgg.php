<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\block\utils\EggCrackState;
use pocketmine\block\utils\SupportType;
use pocketmine\data\runtime\RuntimeDataDescriber;
use pocketmine\item\Item;
use pocketmine\math\Axis;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class TurtleEgg extends Transparent{
	public const MIN_COUNT = 1;
	public const MAX_COUNT = 4;

	protected int $count = self::MIN_COUNT;
	protected EggCrackState $crackState = EggCrackState::NO_CRACKS;

	protected function describeBlockOnlyState(RuntimeDataDescriber $w) : void{
		$w->boundedIntAuto(self::MIN_COUNT, self::MAX_COUNT, $this->count);
		$w->enum($this->crackState);
	}

	public function getCount() : int{ return $this->count; }

	/** @return $this */
	public function setCount(int $count) : self{
		if($count < self::MIN_COUNT || $count > self::MAX_COUNT){
			throw new \InvalidArgumentException("Count must be in range " . self::MIN_COUNT . " ... " . self::MAX_COUNT);
		}
		$this->count = $count;
		return $this;
	}

	public function getCrackState() : EggCrackState{ return $this->crackState; }

	/** @return $this */
	public function setCrackState(EggCrackState $crackState) : self{
		$this->crackState = $crackState;
		return $this;
	}

	public function isSolid() : bool{
		return false;
	}

	protected function recalculateCollisionBoxes() : array{
		return [AxisAlignedBB::one()->squash(Axis::X, 1 / 16)->squash(Axis::Z, 1 / 16)->trim(Facing::UP, 9 / 16)];
	}

	public function getSupportType(int $facing) : SupportType{
		return SupportType::NONE;
	}

	public function canBePlacedAt(Block $blockReplace, Vector3 $clickVector, int $face, bool $isClickedBlock) : bool{
		return ($blockReplace instanceof TurtleEgg && $blockReplace->count < self::MAX_COUNT) || parent::canBePlacedAt($blockReplace, $clickVector, $face, $isClickedBlock);
	}

	public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null) : bool{
		if($blockReplace instanceof TurtleEgg && $blockReplace->count < self::MAX_COUNT){
			$this->count = $blockReplace->count + 1;
			$this->crackState = $blockReplace->crackState;
		}
		return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}

	public function getDropsForCompatibleTool(Item $item) : array{
		return [];
	}

	public function isAffectedBySilkTouch() : bool{
		return true;
	}

	public function getSilkTouchDrops(Item $item) : array{
		return [$this->asItem()->setCount($this->count)];
	}
}

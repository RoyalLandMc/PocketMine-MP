<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\math\Axis;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;

class HoneyBlock extends Transparent{

	protected function recalculateCollisionBoxes() : array{
		return [AxisAlignedBB::one()->squash(Axis::X, 1 / 16)->squash(Axis::Z, 1 / 16)->trim(Facing::UP, 1 / 16)];
	}
}

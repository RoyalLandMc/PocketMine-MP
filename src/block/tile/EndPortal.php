<?php

declare(strict_types=1);

namespace pocketmine\block\tile;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\convert\TypeConverter;

class EndPortal extends Spawnable{
	use PreservedDataTrait;

	protected function addAdditionalSpawnData(CompoundTag $nbt, TypeConverter $typeConverter) : void{

	}
}

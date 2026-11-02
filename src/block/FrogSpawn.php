<?php

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\item\Item;

class FrogSpawn extends Flowable{

	public function getDropsForCompatibleTool(Item $item) : array{
		return [];
	}
}

<?php

declare(strict_types=1);

namespace pocketmine\block\tile;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\Utils;
use pocketmine\VersionInfo;

trait PreservedDataTrait{
	private ?CompoundTag $preservedData = null;

	public function readSaveData(CompoundTag $nbt) : void{
		$data = clone $nbt;
		$data->removeTag(Tile::TAG_ID, Tile::TAG_X, Tile::TAG_Y, Tile::TAG_Z, VersionInfo::TAG_WORLD_DATA_VERSION);
		$this->preservedData = $data;
	}

	protected function writeSaveData(CompoundTag $nbt) : void{
		$this->writePreservedData($nbt);
	}

	protected function writePreservedData(CompoundTag $nbt) : void{
		if($this->preservedData !== null){
			foreach(Utils::promoteKeys($this->preservedData->getValue()) as $name => $tag){
				$nbt->setTag($name, clone $tag);
			}
		}
	}
}

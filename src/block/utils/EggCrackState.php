<?php

declare(strict_types=1);

namespace pocketmine\block\utils;

enum EggCrackState{
	case NO_CRACKS;
	case CRACKED;
	case MAX_CRACKED;
}

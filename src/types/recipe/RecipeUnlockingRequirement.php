<?php

/*
 * This file is part of BedrockProtocol.
 * Copyright (C) 2014-2022 PocketMine Team <https://github.com/pmmp/BedrockProtocol>
 *
 * BedrockProtocol is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace pocketmine\network\mcpe\protocol\types\recipe;

class RecipeUnlockingRequirement{

	public const UNLOCKING_CONTEXT_NONE = 0;
	public const UNLOCKING_CONTEXT_ALWAYS_UNLOCKED = 1;
	public const UNLOCKING_CONTEXT_PLAYER_IN_WATER = 2;
	public const UNLOCKING_CONTEXT_PLAYER_HAS_MANY_ITEMS = 3;

	/**
	 * @param RecipeIngredient[] $ingredients
	 */
	public function __construct(private int $context, private array $ingredients){ }

	public function getContext() : int{ return $this->context; }

	public function getIngredients() : array{ return $this->ingredients; }

	public function addIngredient(RecipeIngredient $ingredient){
		$this->ingredients[] = $ingredient;
	}
}

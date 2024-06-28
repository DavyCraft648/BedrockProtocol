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

namespace pocketmine\network\mcpe\protocol;

use pocketmine\network\mcpe\protocol\serializer\PacketSerializer;
use pocketmine\network\mcpe\protocol\types\ServerboundLoadingScreenPacketType;

class ServerboundLoadingScreenPacket extends DataPacket implements ServerboundPacket{
	public const NETWORK_ID = ProtocolInfo::SERVERBOUND_LOADING_SCREEN_PACKET;

	private ServerboundLoadingScreenPacketType $type;
	private int $loadingScreenId;

	/**
	 * @generate-create-func
	 */
	public static function create(ServerboundLoadingScreenPacketType $type, int $loadingScreenId) : self{
		$result = new self;
		$result->type = $type;
		$result->loadingScreenId = $loadingScreenId;
		return $result;
	}

	public function getType() : ServerboundLoadingScreenPacketType{
		return $this->type;
	}

	public function getLoadingScreenId() : int{
		return $this->loadingScreenId;
	}

	protected function decodePayload(PacketSerializer $in) : void{
		$this->type = ServerboundLoadingScreenPacketType::fromPacket($in->getVarInt());
		$this->loadingScreenId = $in->readOptional(fn() => $in->getLInt());
	}

	protected function encodePayload(PacketSerializer $out) : void{
		$out->putVarInt($this->type->value);
		$out->writeOptional($this->loadingScreenId, $out->putLInt(...));
	}

	public function handle(PacketHandlerInterface $handler) : bool{
		return $handler->handleServerboundLoadingScreen($this);
	}
}

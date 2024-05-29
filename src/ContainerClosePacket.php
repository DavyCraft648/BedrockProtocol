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

class ContainerClosePacket extends DataPacket implements ClientboundPacket, ServerboundPacket{
	public const NETWORK_ID = ProtocolInfo::CONTAINER_CLOSE_PACKET;

	public int $windowId;
	public int $type;
	public bool $server = false;

	/**
	 * @generate-create-func
	 */
	public static function create(int $windowId, int $type, bool $server) : self{
		$result = new self;
		$result->windowId = $windowId;
		$result->type = $type;
		$result->server = $server;
		return $result;
	}

	protected function decodePayload(PacketSerializer $in) : void{
		$this->windowId = $in->getByte();
		if($in->getProtocolId() >= ProtocolInfo::PROTOCOL_1_21_0){
			$this->type = $in->getByte();
		}
		$this->server = $in->getBool();
	}

	protected function encodePayload(PacketSerializer $out) : void{
		$out->putByte($this->windowId);
		if($out->getProtocolId() >= ProtocolInfo::PROTOCOL_1_21_0){
			$out->putByte($this->type);
		}
		$out->putBool($this->server);
	}

	public function handle(PacketHandlerInterface $handler) : bool{
		return $handler->handleContainerClose($this);
	}
}

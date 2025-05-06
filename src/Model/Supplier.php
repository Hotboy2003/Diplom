<?php

namespace App\Model;

class Supplier
{
	private int $id;
	private string $name;
	private string $inn;
	private string $statusName;
	private ?string $website;
	private string $address;
	private ?string $notes;
	private string $supplyTypes;

	public function __construct($id, $name, $inn, $statusName, $website,$address,$notes, $supplyTypes)
	{
		$this->id = $id;
		$this->name = $name;
		$this->inn = $inn;
		$this->statusName = $statusName;
		$this->website = $website;
		$this->address = $address;
		$this->notes = $notes;
		$this->supplyTypes = $supplyTypes;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getINN(): string
	{
		return $this->inn;
	}

	public function getStatusName(): string
	{
		return $this->statusName;
	}

	public function getWebsite()
	{
		return $this->website;
	}

	public function getAddress(): string
	{
		return $this->address;
	}

	public function getNotes()
	{
		return $this->notes;
	}

	public function getSupplyTypes(): string
	{
		return $this->supplyTypes;
	}
}
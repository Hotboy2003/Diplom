<?php

namespace App\Model;

class Contact
{
	private int $id;
	private string $name;
	private string $phone;
	private string $email;

	public function __construct(int $id, string $name, string $phone, string $email)
	{
		$this->id = $id;
		$this->name = $name;
		$this->phone = $phone;
		$this->email = $email;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function getEmail(): string
	{
		return $this->email;
	}
}
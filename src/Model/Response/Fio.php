<?php

namespace Gietos\Dadata\Model\Response;

use Gietos\Dadata\Model\AbstractModel;

class Fio extends AbstractModel
{
    const GENDER_MALE = 'MALE';

    const GENDER_FEMALE = 'FEMALE';

    const GENDER_UNKNOWN = 'UNKNOWN';

    /**
     * @var string
     */
    protected $surname;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $patronymic;

    /**
     * @var string
     */
    protected $gender;

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name)
    {
        $this->name = $name;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic)
    {
        $this->patronymic = $patronymic;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }
}

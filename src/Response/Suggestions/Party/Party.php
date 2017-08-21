<?php

namespace Dadata\Response\Suggestions\Party;

use Dadata\Response\Suggestions\AbstractResponse;

class Party extends AbstractResponse
{
    /**
     * @var string Код юр. лица
     */
    const TYPE_LEGAL = 'LEGAL';
    /**
     * @var string Код индивидуального предпринимателя
     */
    const TYPE_INDIVIDUAL = 'INDIVIDUAL';
    /**
     * @var string Наименование компании одной строкой (как показывается в списке подсказок)
     */
    private $value;
    /**
     * @var string Наименование компании одной строкой (полное)
     */
    private $unrestrictedValue;
    /**
     * @var string КПП
     */
    private $kpp;
    /**
     * @var ManagementDto Информация о руководителе
     */
    private $management;
    /**
     * @var string Тип подразделения (MAIN — головная организация; BRANCH — филиал.)
     */
    private $branchType;
    /**
     * @var string Тип организации
     */
    private $type;
    /**
     * @var OpfDto Информация ОПФ
     */
    private $opf;
    /**
     * @var NameDto Информация о названии организации
     */
    private $name;
    /**
     * @var string ИНН
     */
    private $inn;
    /**
     * @var string ОГРН
     */
    private $ogrn;
    /**
     * @var string ОКПО
     */
    private $okpo;
    /**
     * @var string ОКВЕД
     */
    private $okved;
    /**
     * @var StateDto Информация о статусе
     */
    private $state;
    /**
     * @var AddressDto Информация об адресе
     */
    private $address;

    public function __construct(
        $value,
        $unrestrictedValue,
        $kpp,
        ManagementDto $management,
        $branchType,
        $type,
        OpfDto $opf,
        NameDto $name,
        $inn,
        $ogrn,
        $okpo,
        $okved,
        StateDto $state,
        AddressDto $address
    ) {
        $this->value = $value;
        $this->unrestrictedValue = $unrestrictedValue;
        $this->kpp = $kpp;
        $this->management = $management;
        $this->branchType = $branchType;
        $this->type = $type;
        $this->opf = $opf;
        $this->name = $name;
        $this->inn = $inn;
        $this->ogrn = $ogrn;
        $this->okpo = $okpo;
        $this->okved = $okved;
        $this->state = $state;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnrestrictedValue()
    {
        return $this->unrestrictedValue;
    }

    /**
     * @return string
     */
    public function getKpp()
    {
        return $this->kpp;
    }

    /**
     * @return ManagementDto
     */
    public function getManagement()
    {
        return $this->management;
    }

    /**
     * @return string
     */
    public function getBranchType()
    {
        return $this->branchType;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return OpfDto
     */
    public function getOpf()
    {
        return $this->opf;
    }

    /**
     * @return NameDto
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getInn()
    {
        return $this->inn;
    }

    /**
     * @return string
     */
    public function getOgrn()
    {
        return $this->ogrn;
    }

    /**
     * @return string
     */
    public function getOkpo()
    {
        return $this->okpo;
    }

    /**
     * @return string
     */
    public function getOkved()
    {
        return $this->okved;
    }

    /**
     * @return StateDto
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return AddressDto
     */
    public function getAddress()
    {
        return $this->address;
    }
}

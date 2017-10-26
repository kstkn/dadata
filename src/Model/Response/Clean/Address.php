<?php

namespace Gietos\Dadata\Model\Response\Clean;

class Address extends \Gietos\Dadata\Model\Response\Address
{
    use BaseModel;

    /**
     * @var float Площадь квартиры
     */
    private $flatArea;

    /**
     * @var string Рыночная стоимость м²
     */
    private $squareMeterPrice;

    /**
     * @var string Рыночная стоимость квартиры
     */
    private $flatPrice;

    /**
     * @var string Код ИФНС для организаций (не заполняется)
     */
    private $taxOfficeLegal;

    /**
     * @var string Часовой пояс
     */
    private $timezone;

    /**
     * @var string Внутри кольцевой? (see BELTWAY_HIT_* constants)
     */
    private $beltwayHit;

    /**
     * @var int Расстояние от кольцевой в км.
     *               Заполнено, только если beltway_hit = OUT_MKAD или OUT_KAD, иначе пустое.
     */
    private $beltwayDistance;

    /**
     * @var integer Код полноты (see QC_COMPLETE_* constants)
     */
    private $qcComplete;

    /**
     * @var integer Признак наличия дома в ФИАС - уточняет вероятность успешной доставки письма
     *              (see QC_HOUSE_* constants)
     */
    private $qcHouse;

    /**
     * @var string Нераспознанная часть адреса. Для адреса
     */
    private $unparsedParts;

    /**
     * @var MetroCollection
     */
    private $metro;

    public function __toString()
    {
        return (string) $this->result;
    }

    public function getFlatArea(): ?float
    {
        return $this->flatArea;
    }

    public function setFlatArea(?float $flatArea)
    {
        $this->flatArea = $flatArea;
    }

    public function getSquareMeterPrice(): ?string
    {
        return $this->squareMeterPrice;
    }

    public function setSquareMeterPrice(?string $squareMeterPrice)
    {
        $this->squareMeterPrice = $squareMeterPrice;
    }

    public function getFlatPrice(): ?string
    {
        return $this->flatPrice;
    }

    public function setFlatPrice(?string $flatPrice)
    {
        $this->flatPrice = $flatPrice;
    }

    public function getTaxOfficeLegal(): ?string
    {
        return $this->taxOfficeLegal;
    }

    public function setTaxOfficeLegal(?string $taxOfficeLegal)
    {
        $this->taxOfficeLegal = $taxOfficeLegal;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(?string $timezone)
    {
        $this->timezone = $timezone;
    }

    public function getBeltwayHit(): ?string
    {
        return $this->beltwayHit;
    }

    public function setBeltwayHit(?string $beltwayHit)
    {
        $this->beltwayHit = $beltwayHit;
    }

    public function getBeltwayDistance(): ?int
    {
        return $this->beltwayDistance;
    }

    public function setBeltwayDistance(?int $beltwayDistance)
    {
        $this->beltwayDistance = $beltwayDistance;
    }

    public function getQcComplete(): ?int
    {
        return $this->qcComplete;
    }

    public function setQcComplete(?int $qcComplete)
    {
        $this->qcComplete = $qcComplete;
    }

    public function getQcHouse(): ?int
    {
        return $this->qcHouse;
    }

    public function setQcHouse(?int $qcHouse)
    {
        $this->qcHouse = $qcHouse;
    }

    public function getUnparsedParts(): ?string
    {
        return $this->unparsedParts;
    }

    public function setUnparsedParts(?string $unparsedParts)
    {
        $this->unparsedParts = $unparsedParts;
    }

    public function getMetro(): MetroCollection
    {
        return $this->metro;
    }

    public function setMetro(MetroCollection $metro)
    {
        $this->metro = $metro;
    }
}

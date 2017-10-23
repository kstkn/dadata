<?php

namespace Dadata\Response\Suggestions\Party;

class StateDto
{
    /**
     * @var string действующая
     */
    const ACTIVE = 'ACTIVE';
    /**
     * @var string ликвидируется
     */
    const LIQUIDATING = 'LIQUIDATING';
    /**
     * @var string ликвидирована
     */
    const LIQUIDATED = 'LIQUIDATED';

    /**
     * @var string Код статуса
     */
    private $status;

    /**
     * @var \DateTime | null Дата актуальности сведений
     */
    private $actualityDate;
    /**
     * @var \DateTime | null Дата регистрации
     */
    private $registrationDate;
    /**
     * @var \DateTime | null Дата ликвидации
     */
    private $liquidationDate;

    public function __construct(
        $status,
        $actualityDate,
        $registrationDate,
        $liquidationDate
    ) {
        $this->status = $status;
        $this->actualityDate = $actualityDate === null ? null : \DateTime::createFromFormat('U', $actualityDate / 1000);
        $this->registrationDate = $registrationDate === null ? null : \DateTime::createFromFormat('U',
            $registrationDate / 1000);
        $this->liquidationDate = $liquidationDate === null ? null : \DateTime::createFromFormat('U',
            $liquidationDate / 1000);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return \DateTime | null
     */
    public function getActualityDate()
    {
        return $this->actualityDate;
    }

    /**
     * @return \DateTime | null
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * @return \DateTime | null
     */
    public function getLiquidationDate()
    {
        return $this->liquidationDate;
    }
}
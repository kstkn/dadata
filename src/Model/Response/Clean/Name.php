<?php

namespace Gietos\Dadata\Model\Response\Clean;

use Gietos\Dadata\Model\Response\Fio;

class Name extends Fio
{
    const GENDER_MALE = 'М';

    const GENDER_FEMALE = 'Ж';

    const GENDER_UNKNOWN = 'НД';

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $result;

    /**
     * @var string
     */
    private $resultGenitive;

    /**
     * @var string
     */
    private $resultDative;

    /**
     * @var string
     */
    private $resultAblative;

    /**
     * @var int
     */
    private $qc;

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source)
    {
        $this->source = $source;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function setResult(string $result)
    {
        $this->result = $result;
    }

    public function getResultGenitive(): string
    {
        return $this->resultGenitive;
    }

    public function setResultGenitive(string $resultGenitive)
    {
        $this->resultGenitive = $resultGenitive;
    }

    public function getResultDative(): string
    {
        return $this->resultDative;
    }

    public function setResultDative(string $resultDative)
    {
        $this->resultDative = $resultDative;
    }

    public function getResultAblative(): string
    {
        return $this->resultAblative;
    }

    public function setResultAblative(string $resultAblative)
    {
        $this->resultAblative = $resultAblative;
    }

    public function getQc(): int
    {
        return $this->qc;
    }

    public function setQc(int $qc)
    {
        $this->qc = $qc;
    }
}

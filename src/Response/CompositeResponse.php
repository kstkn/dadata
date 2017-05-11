<?php
declare(strict_types=1);

namespace Dadata\Response;

class CompositeResponse
{
    /**
     * @var Address
     */
    protected $address;
    /**
     * @var Phone
     */
    protected $phone;
    /**
     * @var Passport
     */
    protected $passport;
    /**
     * @var Name
     */
    protected $name;
    /**
     * @var Email
     */
    protected $email;
    /**
     * @var Vehicle
     */
    protected $vehicle;

    /**
     * все сущности распознаны уверенно, ручная проверка не требуется
     *
     * @return bool
     */
    public function isAggregateQualityCodeOk(): bool
    {
        if ($this->isAddressExists()) {
            if ($this->getAddress()->qc !== Address::QC_OK) {
                return false;
            }
        }
        if ($this->isPhoneExists()) {
            if ($this->getPhone()->qc !== Phone::QC_OK) {
                return false;
            }
        }
        if ($this->isPassportExists()) {
            if ($this->getPassport()->qc !== Passport::QC_OK) {
                return false;
            }
        }
        if ($this->isNameExists()) {
            if ($this->getName()->qc !== Name::QC_OK) {
                return false;
            }
        }
        if ($this->isEmailExists()) {
            if ($this->getEmail()->qc !== Email::QC_OK) {
                return false;
            }
        }
        if ($this->isVehicleExists()) {
            if ($this->getVehicle()->qc !== Vehicle::QC_OK) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    public function isVehicleExists(): bool
    {
        return $this->vehicle !== null;
    }

    /**
     * @return bool
     */
    public function isEmailExists(): bool
    {
        return $this->email !== null;
    }

    /**
     * @return bool
     */
    public function isNameExists(): bool
    {
        return $this->name !== null;
    }

    /**
     * @return bool
     */
    public function isPassportExists(): bool
    {
        return $this->passport !== null;
    }

    /**
     * @return bool
     */
    public function isPhoneExists(): bool
    {
        return $this->phone !== null;
    }

    /**
     * @return bool
     */
    public function isAddressExists(): bool
    {
        return $this->address !== null;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param AbstractResponse $address
     */
    public function setAddress(AbstractResponse $address)
    {
        $this->address = $address;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @param AbstractResponse $phone
     */
    public function setPhone(AbstractResponse $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return Passport
     */
    public function getPassport(): Passport
    {
        return $this->passport;
    }

    /**
     * @param AbstractResponse $passport
     */
    public function setPassport(AbstractResponse $passport)
    {
        $this->passport = $passport;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @param AbstractResponse $name
     */
    public function setName(AbstractResponse $name)
    {
        $this->name = $name;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @param AbstractResponse $email
     */
    public function setEmail(AbstractResponse $email)
    {
        $this->email = $email;
    }

    /**
     * @return Vehicle
     */
    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }

    /**
     * @param AbstractResponse $vehicle
     */
    public function setVehicle(AbstractResponse $vehicle)
    {
        $this->vehicle = $vehicle;
    }
}
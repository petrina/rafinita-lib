<?php

namespace Lib\Rafinita\Entity;

use Lib\Rafinita\Helper\HashHelper;
use Lib\Rafinita\Requests\DTO\SaleRequestDTO;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\ExpressionSyntax;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class SaleEntity
{

    protected string $clientKey;
    protected ?string $channelId = null;
    protected string $orderId;
    protected string $orderAmount;
    protected string $orderCurrency;
    protected string $orderDescription;
    protected string $cardNumber;
    protected string $cardExpMonth;
    protected string $cardExpYear;
    protected string $cardCvv2;
    protected string $payerFirstName;
    protected string $payerLastName;
    protected ?string $payerMiddleName = null;
    protected ?string $payerBirthDate = null;
    protected string $payerAddress;
    protected ?string $payerAddress2 = null;
    protected string $payerCountry;
    protected ?string $payerState = null;
    protected string $payerCity;
    protected string $payerZip;
    protected string $payerEmail;
    protected string $payerPhone;
    protected string $payerIp;
    protected string $termUrl3ds;
    protected ?string $recurringInit = null;
    protected ?string $auth = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('clientKey', new Uuid());
        $metadata->addPropertyConstraint('channelId', new Length(['max' => 16]));
        $metadata->addPropertyConstraint('orderId', new NotBlank());
        $metadata->addPropertyConstraint('orderId', new Length(['max' => 255]));
        $metadata->addPropertyConstraint('orderAmount', new NotBlank());
        $metadata->addPropertyConstraint('orderAmount', new NotBlank());
        $metadata->addPropertyConstraint('orderAmount', new Regex(['pattern' => '/^[0-9]{1,5}\.[0-9]{2}$/']));
        $metadata->addPropertyConstraint('orderCurrency', new NotBlank());
        $metadata->addPropertyConstraint('orderCurrency', new Length(['max' => 3, 'min' => 3]));
        $metadata->addPropertyConstraint('orderDescription', new NotBlank());
        $metadata->addPropertyConstraint('orderDescription', new Length(['max' => 1024]));
        $metadata->addPropertyConstraint('cardNumber', new NotBlank());
        $metadata->addPropertyConstraint('cardExpMonth', new NotBlank());
        $metadata->addPropertyConstraint('cardExpMonth', new Regex(['pattern' => '/^[0-9]{2}$/']));
        $metadata->addPropertyConstraint('cardExpYear', new NotBlank());
        $metadata->addPropertyConstraint('cardExpYear', new Regex(['pattern' => '/^[0-9]{4}$/']));
        $metadata->addPropertyConstraint('cardCvv2', new NotBlank());
        $metadata->addPropertyConstraint('cardCvv2', new Regex(['pattern' => '/^[0-9]{3,4}$/']));
        $metadata->addPropertyConstraint('payerFirstName', new NotBlank());
        $metadata->addPropertyConstraint('payerFirstName', new Length(['max' => 32]));
        $metadata->addPropertyConstraint('payerLastName', new NotBlank());
        $metadata->addPropertyConstraint('payerLastName', new Length(['max' => 32]));
        $metadata->addPropertyConstraint('payerMiddleName', new Length(['max' => 32]));
        $metadata->addPropertyConstraint('payerBirthDate', new Regex(['pattern' => '/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/']));
        $metadata->addPropertyConstraint('payerAddress', new NotBlank());
        $metadata->addPropertyConstraint('payerAddress', new Length(['max' => 255]));
        $metadata->addPropertyConstraint('payerAddress2', new Length(['max' => 255]));
        $metadata->addPropertyConstraint('payerCountry', new NotBlank());
        $metadata->addPropertyConstraint('payerCountry', new Regex(['pattern' => '/^[A-Z]{2}$/']));
        $metadata->addPropertyConstraint('payerState', new Length(['max' => 32]));
        $metadata->addPropertyConstraint('payerCity', new NotBlank());
        $metadata->addPropertyConstraint('payerCity', new Length(['max' => 32]));
        $metadata->addPropertyConstraint('payerZip', new NotBlank());
        $metadata->addPropertyConstraint('payerZip', new Length(['max' => 10]));
        $metadata->addPropertyConstraint('payerEmail', new NotBlank());
        $metadata->addPropertyConstraint('payerEmail', new Email());
        $metadata->addPropertyConstraint('payerPhone', new NotBlank());
        $metadata->addPropertyConstraint('payerPhone', new Length(['max' => 32]));
        $metadata->addPropertyConstraint('payerPhone', new NotBlank());
        $metadata->addPropertyConstraint('payerIp', new Ip(['version' => 4]));
        $metadata->addPropertyConstraint('termUrl3ds', new NotBlank());
        $metadata->addPropertyConstraint('termUrl3ds', new Length(['max' => 1024]));
        $metadata->addPropertyConstraint('recurringInit', new ExpressionSyntax(['allowedVariables' => ['Y', 'N']]));
        $metadata->addPropertyConstraint('auth', new ExpressionSyntax(['allowedVariables' => ['Y', 'N']]));
    }

    public function getRequestDTO(): SaleRequestDTO
    {
        $requestDTO = new SaleRequestDTO(
            $this->getClientKey(),
            $this->getOrderId(),
            $this->getOrderAmount(),
            $this->getOrderCurrency(),
            $this->getOrderDescription(),
            $this->getCardNumber(),
            $this->getCardExpMonth(),
            $this->getCardExpYear(),
            $this->getCardCvv2(),
            $this->getPayerFirstName(),
            $this->getPayerLastName(),
            $this->getPayerAddress(),
            $this->getPayerCountry(),
            $this->getPayerCity(),
            $this->getPayerZip(),
            $this->getPayerEmail(),
            $this->getPayerPhone(),
            $this->getPayerIp(),
            $this->getTermUrl3ds(),
            HashHelper::generate($this->getPayerEmail(), $this->getCardNumber())
        );
        $requestDTO->setPayerMiddleName($this->getPayerMiddleName());
        $requestDTO->setPayerBirthDate($this->getPayerBirthDate());
        $requestDTO->setPayerAddress2($this->getPayerAddress2());
        $requestDTO->setPayerState($this->getPayerState());
        $requestDTO->setChannelId($this->getChannelId());
        $requestDTO->setRecurringInit($this->getRecurringInit());
        $requestDTO->setAuth($this->getAuth());
        return $requestDTO;
    }

    public function getClientKey(): string
    {
        return $this->clientKey;
    }

    public function setClientKey(string $clientKey): SaleEntity
    {
        $this->clientKey = $clientKey;
        return $this;
    }

    public function getChannelId(): ?string
    {
        return $this->channelId;
    }

    public function setChannelId(?string $channelId): SaleEntity
    {
        $this->channelId = $channelId;
        return $this;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): SaleEntity
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getOrderAmount(): string
    {
        return $this->orderAmount;
    }

    public function setOrderAmount(string $orderAmount): SaleEntity
    {
        $this->orderAmount = $orderAmount;
        return $this;
    }

    public function getOrderCurrency(): string
    {
        return $this->orderCurrency;
    }

    public function setOrderCurrency(string $orderCurrency): SaleEntity
    {
        $this->orderCurrency = $orderCurrency;
        return $this;
    }

    public function getOrderDescription(): string
    {
        return $this->orderDescription;
    }

    public function setOrderDescription(string $orderDescription): SaleEntity
    {
        $this->orderDescription = $orderDescription;
        return $this;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): SaleEntity
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    public function getCardExpMonth(): string
    {
        return $this->cardExpMonth;
    }

    public function setCardExpMonth(string $cardExpMonth): SaleEntity
    {
        $this->cardExpMonth = $cardExpMonth;
        return $this;
    }

    public function getCardExpYear(): string
    {
        return $this->cardExpYear;
    }

    public function setCardExpYear(string $cardExpYear): SaleEntity
    {
        $this->cardExpYear = $cardExpYear;
        return $this;
    }

    public function getCardCvv2(): string
    {
        return $this->cardCvv2;
    }

    public function setCardCvv2(string $cardCvv2): SaleEntity
    {
        $this->cardCvv2 = $cardCvv2;
        return $this;
    }

    public function getPayerFirstName(): string
    {
        return $this->payerFirstName;
    }

    public function setPayerFirstName(string $payerFirstName): SaleEntity
    {
        $this->payerFirstName = $payerFirstName;
        return $this;
    }

    public function getPayerLastName(): string
    {
        return $this->payerLastName;
    }

    public function setPayerLastName(string $payerLastName): SaleEntity
    {
        $this->payerLastName = $payerLastName;
        return $this;
    }

    public function getPayerMiddleName(): ?string
    {
        return $this->payerMiddleName;
    }

    public function setPayerMiddleName(?string $payerMiddleName): SaleEntity
    {
        $this->payerMiddleName = $payerMiddleName;
        return $this;
    }

    public function getPayerBirthDate(): ?string
    {
        return $this->payerBirthDate;
    }

    public function setPayerBirthDate(?string $payerBirthDate): SaleEntity
    {
        $this->payerBirthDate = $payerBirthDate;
        return $this;
    }

    public function getPayerAddress(): string
    {
        return $this->payerAddress;
    }

    public function setPayerAddress(string $payerAddress): SaleEntity
    {
        $this->payerAddress = $payerAddress;
        return $this;
    }

    public function getPayerAddress2(): ?string
    {
        return $this->payerAddress2;
    }

    public function setPayerAddress2(?string $payerAddress2): SaleEntity
    {
        $this->payerAddress2 = $payerAddress2;
        return $this;
    }

    public function getPayerCountry(): string
    {
        return $this->payerCountry;
    }

    public function setPayerCountry(string $payerCountry): SaleEntity
    {
        $this->payerCountry = $payerCountry;
        return $this;
    }

    public function getPayerState(): ?string
    {
        return $this->payerState;
    }

    public function setPayerState(?string $payerState): SaleEntity
    {
        $this->payerState = $payerState;
        return $this;
    }

    public function getPayerCity(): string
    {
        return $this->payerCity;
    }

    public function setPayerCity(string $payerCity): SaleEntity
    {
        $this->payerCity = $payerCity;
        return $this;
    }

    public function getPayerZip(): string
    {
        return $this->payerZip;
    }

    public function setPayerZip(string $payerZip): SaleEntity
    {
        $this->payerZip = $payerZip;
        return $this;
    }

    public function getPayerEmail(): string
    {
        return $this->payerEmail;
    }

    public function setPayerEmail(string $payerEmail): SaleEntity
    {
        $this->payerEmail = $payerEmail;
        return $this;
    }

    public function getPayerPhone(): string
    {
        return $this->payerPhone;
    }

    public function setPayerPhone(string $payerPhone): SaleEntity
    {
        $this->payerPhone = $payerPhone;
        return $this;
    }

    public function getPayerIp(): string
    {
        return $this->payerIp;
    }

    public function setPayerIp(string $payerIp): SaleEntity
    {
        $this->payerIp = $payerIp;
        return $this;
    }

    public function getTermUrl3ds(): string
    {
        return $this->termUrl3ds;
    }

    public function setTermUrl3ds(string $termUrl3ds): SaleEntity
    {
        $this->termUrl3ds = $termUrl3ds;
        return $this;
    }

    public function getRecurringInit(): ?string
    {
        return $this->recurringInit;
    }

    public function setRecurringInit(?string $recurringInit): SaleEntity
    {
        $this->recurringInit = $recurringInit;
        return $this;
    }

    public function getAuth(): ?string
    {
        return $this->auth;
    }

    public function setAuth(?string $auth): SaleEntity
    {
        $this->auth = $auth;
        return $this;
    }
}
<?php

namespace App\Rafinita\Requests\DTO;

class SaleRequestDTO extends AbstractRequestDTO
{
    protected const ACTION = 'SALE';
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
    protected string $hash;

    public function __construct(
        string  $clientKey,
        string  $orderId,
        string  $orderAmount,
        string  $orderCurrency,
        string  $orderDescription,
        string  $cardNumber,
        string  $cardExpMonth,
        string  $cardExpYear,
        string  $cardCvv2,
        string  $payerFirstName,
        string  $payerLastName,
        string  $payerAddress,
        string  $payerCountry,
        string  $payerCity,
        string  $payerZip,
        string  $payerEmail,
        string  $payerPhone,
        string  $payerIp,
        string  $termUrl3ds,
        string  $hash
    )
    {
        $this->clientKey = $clientKey;
        $this->orderId = $orderId;
        $this->orderAmount = $orderAmount;
        $this->orderCurrency = $orderCurrency;
        $this->orderDescription = $orderDescription;
        $this->cardNumber = $cardNumber;
        $this->cardExpMonth = $cardExpMonth;
        $this->cardExpYear = $cardExpYear;
        $this->cardCvv2 = $cardCvv2;
        $this->payerFirstName = $payerFirstName;
        $this->payerLastName = $payerLastName;
        $this->payerAddress = $payerAddress;
        $this->payerCountry = $payerCountry;
        $this->payerCity = $payerCity;
        $this->payerZip = $payerZip;
        $this->payerEmail = $payerEmail;
        $this->payerPhone = $payerPhone;
        $this->payerIp = $payerIp;
        $this->termUrl3ds = $termUrl3ds;
        $this->hash = $hash;
    }

    public function serialize(): array
    {
        return [
            'action' => self::ACTION,
            'client_key' => $this->clientKey,
            'channel_id' => $this->channelId,
            'order_id' => $this->orderId,
            'order_amount' => $this->orderAmount,
            'order_currency' => $this->orderCurrency,
            'order_description' => $this->orderDescription,
            'card_number' => $this->cardNumber,
            'card_exp_month' => $this->cardExpMonth,
            'card_exp_year' => $this->cardExpYear,
            'card_cvv2' => $this->cardCvv2,
            'payer_first_name' => $this->payerFirstName,
            'payer_last_name' => $this->payerLastName,
            'payer_middle_name' => $this->payerMiddleName,
            'payer_birth_date' => $this->payerBirthDate,
            'payer_address' => $this->payerAddress,
            'payer_address2' => $this->payerAddress2,
            'payer_country' => $this->payerCountry,
            'payer_state' => $this->payerState,
            'payer_city' => $this->payerCity,
            'payer_zip' => $this->payerZip,
            'payer_email' => $this->payerEmail,
            'payer_phone' => $this->payerPhone,
            'payer_ip' => $this->payerIp,
            'term_url_3ds' => $this->termUrl3ds,
            'recurring_init' => $this->recurringInit,
            'auth' => $this->auth,
            'hash' => $this->hash,
        ];
    }

    public function setChannelId(?string $channelId): void
    {
        $this->channelId = $channelId;
    }

    public function setPayerMiddleName(?string $payerMiddleName): void
    {
        $this->payerMiddleName = $payerMiddleName;
    }

    public function setPayerBirthDate(?string $payerBirthDate): void
    {
        $this->payerBirthDate = $payerBirthDate;
    }

    public function setPayerState(?string $payerState): void
    {
        $this->payerState = $payerState;
    }

    public function setRecurringInit(?string $recurringInit): void
    {
        $this->recurringInit = $recurringInit;
    }

    public function setAuth(?string $auth): void
    {
        $this->auth = $auth;
    }

    public function setPayerAddress2(?string $payerAddress2): void
    {
        $this->payerAddress2 = $payerAddress2;
    }
}
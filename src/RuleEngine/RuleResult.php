<?php

namespace Jafar\LaravelBusinessRules\RuleEngine;

use Illuminate\Http\JsonResponse;
use Jafar\LaravelBusinessRules\Interfaces\Rulable;

class RuleResult
{
    protected $rule;

    protected bool $result;

    protected ?string $errorMessage;

    protected ?int $statusCode;

    protected ?bool $isCritical;

    protected ?int $severity;

    /**
     * @param  Rulable  $rule
     */
    public function __construct($rule)
    {
        $this->rule = $rule;
        $this->statusCode = null;
        $this->errorMessage = null;
        $this->severity = null;
    }

    /**
     * @return bool
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->result == true;
    }

    /**
     * @return bool
     */
    public function hasFailed(): bool
    {
        return $this->result == false;
    }

    /**
     * @param  bool  $result
     */
    public function setResult(bool $result): void
    {
        $this->result = $result;
    }

    public function withResult(bool $result): self
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @param  string  $errorMessage
     */
    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @param  string  $message
     * @return RuleResult
     */
    public function withMessage(string $message): self
    {
        $this->errorMessage = $message;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * @param  int  $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function getRule(): Rulable
    {
        return $this->rule;
    }

    public function setIsCritical(bool $isCritical = false): void
    {
        $this->isCritical = $isCritical;
    }

    public function isCritical(): ?bool
    {
        return $this->isCritical;
    }

    public function setSeverity(?int $severity): void
    {
        $this->severity = $severity;
    }

    public function getSeverity(): ?int
    {
        return $this->severity;
    }

    /**
     * @param  int  $statusCode
     * @return $this
     */
    public function withStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function toExceptionResponse(): JsonResponse
    {
        return response()->json([
            'message' => $this->getErrorMessage(),
            'success' => $this->result,
            'status_code' => $this->getStatusCode(),
            'data' => [],
        ], $this->getStatusCode());
    }
}

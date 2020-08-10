<?php
namespace App\DTO;

use App\Commons\Kernels\DTO;
use App\DTO\Base\AbstractListDTO;

class  LiveStoreDTO extends AbstractListDTO
{
    /**
     * @var string
     */
    protected $subject;

    /**
     * @var int | null
     */
    protected $live_time;

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return int|null
     */
    public function getLiveTime(): ?int
    {
        return $this->live_time;
    }

    /**
     * @param int|null $live_time
     */
    public function setLiveTime(?int $live_time): void
    {
        $this->live_time = $live_time;
    }




}

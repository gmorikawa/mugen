<?php

namespace App\Shared\Stream;

use Illuminate\Http\UploadedFile;

class UploadStream
{
    private UploadedFile $stream;

    public function __construct(UploadedFile $stream)
    {
        $this->stream = $stream;
    }

    public function getClientOriginalName(): string
    {
        return $this->stream->getClientOriginalName();
    }

    public function getClientOriginalExtension(): string
    {
        return $this->stream->getClientOriginalExtension();
    }

    public function getStream()
    {
        return fopen($this->stream->getRealPath(), 'r');
    }
}
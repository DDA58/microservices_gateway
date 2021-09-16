<?php

namespace App\Services\Microservice;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FilesUploader extends AMicroservice
{
    protected function preRequest(): void
    {
        if (!$this->request->files->count()) {
            return;
        }

        unset($this->client_options['body']);
        unset($this->client_options['headers']['content-type']);

        /** @var UploadedFile $file */
        foreach ($this->request->files as $index => $files) {
            foreach ($files as $i => $file) {
                $this->client_options['multipart'][] = [
                    'name'     => $index.$i,
                    'contents' => $file->getContent(),
                    'filename' => $file->getClientOriginalName(),
                    'mime' => $file->getMimeType()
                ];
            }
        }
    }
}

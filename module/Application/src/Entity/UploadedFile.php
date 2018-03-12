<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UploadedFile
 *
 * @ORM\Table(name="uploaded_file")
 * @ORM\Entity
 */
class UploadedFile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="uploaded_file_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uploadedFileId;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=100, nullable=false)
     */
    private $fileName;

    /**
     * Get uploadedFileId
     *
     * @return integer
     */
    public function getUploadedFileId()
    {
        return $this->uploadedFileId;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return UploadedFile
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }
}

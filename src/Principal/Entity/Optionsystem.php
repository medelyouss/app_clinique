<?php

namespace App\Principal\Entity;

use App\Principal\Repository\OptionsystemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=OptionsystemRepository::class)
 * @Vich\Uploadable
 */
class Optionsystem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $copyright;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $youtube;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlsiteweb;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     * @var string
     */
    private $imgMainlogo;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     * @var string
     */
    private $imgMainlogomobile;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     * @var string
     */
    private $imgNoimage;

    /**
     * @Vich\UploadableField(mapping="imgSystem", fileNameProperty="imgMainlogo")
     * @var File
     */
    private $imgMainlogoFile;

    /**
     * @Vich\UploadableField(mapping="imgSystem", fileNameProperty="imgMainlogomobile")
     * @var File
     */
    private $imgMainlogomobileFile;

    /**
     * @Vich\UploadableField(mapping="imgSystem", fileNameProperty="imgNoimage")
     * @var File
     */
    private $imgNoimageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    public function setCopyright(string $copyright): self
    {
        $this->copyright = $copyright;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getUrlsiteweb(): ?string
    {
        return $this->urlsiteweb;
    }

    public function setUrlsiteweb(?string $urlsiteweb): self
    {
        $this->urlsiteweb = $urlsiteweb;

        return $this;
    }

    /**
     * ============================================================
     * @param File|null $imgMainlogo
     */
    public function setImgMainlogoFile(File $imgMainlogo = null)
    {
        $this->imgMainlogoFile = $imgMainlogo;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imgMainlogo) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImgMainlogoFile()
    {
        return $this->imgMainlogoFile;
    }

    public function setImgMainlogo($imgMainlogo)
    {
        $this->imgMainlogo = $imgMainlogo;
    }

    public function getImgMainlogo()
    {
        return $this->imgMainlogo;
    }

    /**
     * =================================================================================================
     * @param File|null $imgMainlogomobile
     */
    public function setImgMainlogomobileFile(File $imgMainlogomobile = null)
    {
        $this->imgMainlogomobileFile = $imgMainlogomobile;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imgMainlogomobile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImgMainlogomobileFile()
    {
        return $this->imgMainlogomobileFile;
    }

    public function setImgMainlogomobile($imgMainlogomobile)
    {
        $this->imgMainlogomobile = $imgMainlogomobile;
    }

    public function getImgMainlogomobile()
    {
        return $this->imgMainlogomobile;
    }
    /**
     * ============================================================
     * @param File|null $imgNoimage
     */
    public function setImgNoimageFile(File $imgNoimage = null)
    {
        $this->imgNoimageFile = $imgNoimage;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imgNoimage) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImgNoimageFile()
    {
        return $this->imgNoimageFile;
    }

    public function setImgNoimage($imgNoimage)
    {
        $this->imgNoimage = $imgNoimage;
    }

    public function getImgNoimage()
    {
        return $this->imgNoimage;
    }
}

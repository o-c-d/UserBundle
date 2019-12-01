<?php

namespace Ocd\UserBundle\Model;

use Doctrine\ORM\Mapping as ORM;

trait PersonnalDataTrait
{

    /**
     * Full Name
     * @ORM\Column(name="fullName", type="string", nullable=true)
     */
    protected $fullName;

    /**
     * First Name
     * @ORM\Column(name="firstname", type="string", nullable=true)
     */
    protected $firstname;

    /**
     * Last Name
     * @ORM\Column(name="lastname", type="string", nullable=true)
     */
    protected $lastname;

    /**
     * Date of birth
     * @ORM\Column(name="dateofbirth", type="datetime", nullable=true)
     */
    protected $dateofbirth;

    /**
     * Gender
     * @ORM\Column(name="gender", type="string", nullable=true)
     */
    protected $gender;

    /**
     * Picture
     * @ORM\Column(name="picture", type="string", nullable=true)
     */
    protected $picture;

    /**
     * Organisation
     * @ORM\Column(name="organisation", type="string", nullable=true)
     */
    protected $organisation;
}

<?php

use Symfony\Component\Validator\Constraints as Assert;

class ClientCreateForm {
    /**
     * @Assert\NotBlank(message="Le nom de famille ne doit pas être vide")
     * @Assert\NotNull(message="can not be null :/")
     * @Assert\Length(min=4, minMessage="Le nombre de caractère doit être suppérieur à 4")
     */
    public $lastname;
    /**
     * @Assert\NotBlank(message="Le nom de famille ne doit pas être vide")
     * @Assert\NotNull(message="can not be null :/")
     * @Assert\Length(min=1, minMessage="minErrorMessage")
     */
    public $firstname;
    public $birthDate;
}
<?php

namespace BackendBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class SolicitudTurno
{
    /**
     * @Assert\NotBlank(message="El campo no debe estar vacio")
	 * @Assert\Length(
    
     *      max = 50,
     *      maxMessage = "Tu nombre debe tener como máximo {{ limit }} letras"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="El nombre y apellido no es válido."
     * )
     */
    public $nomyap;

    /**
    * @Assert\NotBlank(message="El campo no debe estar vacio")
     * @Assert\Email(
     *     message = "El correo '{{ value }}' no es válido.",
     *     checkMX = true
     * )
     */
    public $email;


    /**
     * @Assert\NotBlank(message="El campo no debe estar vacio")
     * @Assert\Type(
     *     type="numeric",
     *     message="El nro de teléfono no es válido"
     * )
     */
    public $telefono;

    /**
     * @Assert\NotBlank(message="El campo no debe estar vacio")
     * @Assert\Length(
    
     *      max = 300,
     *      maxMessage = "Tu nombre debe tener como máximo {{ limit }} letras"
     * )
     */
    public $mensaje;
}

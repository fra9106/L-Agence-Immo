<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields = {"email"},
 * message = "Email déjà utilisé, veuillez taper un autre email !")
 */
class User implements UserInterface // interface pour encoder le mdp de user 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=8, minMessage="8 Caractères minimum pour le mot de passe")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Mots de passe différents, veuilliez retaper un mot de passe identique")
     */

    public $confirm_password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

   /* public function getConfirm_password(): ?string
    {
        return $this->confirm_password;
    }

    public function setConfirm_password(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

        return $this;
    }*/

    public function eraseCredentials(){} //fonction vide obligatoire pour l'implémentation 

    public function getSalt(){} //fonction vide obligatoire pour l'implémentation 

    public function getRoles(): array //chek les rôles dans les users à la connexion 
    {
       $roles = $this->roles;
       $roles[] = 'ROLE_USER'; //par défaut chaque user à un ROLE_USER
       return array_unique($roles);
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

}

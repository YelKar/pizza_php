<?php
declare(strict_types=1);

namespace App\Controller\Input;

use App\Entity\UserRole;
use App\Service\Input\RegisterUserInputInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterUserInput extends AbstractType implements RegisterUserInputInterface
{
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $phone = null;
    private ?string $avatar = null;
    private ?string $role = null;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;
        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): static
    {
        $this->avatar = $avatar;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('email', EmailType::class)
            ->add('phone', TelType::class)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('password', PasswordType::class)
            ->add('avatar', FileType::class, ["attr" => ["accept" => "image/*"], "required" => false])
            ->add('submit', SubmitType::class);
    }
}

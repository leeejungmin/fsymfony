<?php

namespace App\Entity;


use JsonSerializable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
// use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\ExclusionPolicy;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ExclusionPolicy("NONE")
 * @UniqueEntity(
 * fields= {"email"},
 * message= "l'email que vous avez indique est deja utilise")
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="4", minMessage="Votre mot de passe doit fiare minimum 4")
     * @Assert\EqualTo(propertyPath="confirm_password")
     * @Exclude
     */
    private $password;
    /**
     * @Assert\EqualTo(propertyPath="password", message="vous n'avez pas tape le mem mot de passe" )
     * @Exclude
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="User")
     * @Exclude
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Amis", mappedBy="amis")
     * @Exclude
     */
    private $amis;

    /**
      * Many Users have Many Users.
      * @ORM\ManyToMany(targetEntity="User", mappedBy="myFriends")
      * @Exclude
      */
     private $friendsWithMe;

     /**
     * @Exclude
      * Many Users have many Users.
      * @ORM\ManyToMany(targetEntity="User", inversedBy="friendsWithMe")
      * @ORM\JoinTable(name="friends",
      *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
      *      inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
      *      )
      */
     private $myFriends;





    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->amis = new ArrayCollection();
        $this->users = new ArrayCollection();

        $this->friendsWithMe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myFriends = new \Doctrine\Common\Collections\ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function eraseCredentials() {}
    public function getSalt() {}
    public function getRoles() {
        return ['ROLE_USER' ];
    }

    /**
     * @Exclude
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setUser($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getUser() === $this) {
                $article->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @Exclude
     * @return Collection|Amis[]
     */
    public function getAmis(): Collection
    {
        return $this->amis;
    }

    public function addAmi(Amis $ami): self
    {
        if (!$this->amis->contains($ami)) {
            $this->amis[] = $ami;
            $ami->addAmi($this);
        }

        return $this;
    }

    public function removeAmi(Amis $ami): self
    {
        if ($this->amis->contains($ami)) {
            $this->amis->removeElement($ami);
            $ami->removeAmi($this);
        }

        return $this;
    }

   //  /**
   //  * @return array
   //  */
   // public function getFriends()
   // {
   //     return $this->friends->toArray();
   // }



    /**
     * @Exclude
     * @return Collection|myFriends[]
     */
    public function getUsers(): Collection
    {
        return $this->myFriends;
    }

    public function addUser(User $user): self
    {
        if (!$this->myFriends->contains($user)) {
            $this->myFriends[] = $user;
            $user->addUser($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->myFriends->contains($user)) {
            $this->myFriends->removeElement($user);
            $user->removeUser($this);
        }

        return $this;
    }



}

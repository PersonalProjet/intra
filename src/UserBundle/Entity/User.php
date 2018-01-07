<?php

namespace Core\UserBundle\Entity;

use App\BanqueBundle\Entity\Banque;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Core\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $facebookID;

    /**
     * @var string
     * @ORM\Column(name="facebook_access_token", type="text")
     */
    protected $facebook_access_token;

    /**
     * @var string
     * @ORM\Column(name="picture", type="text")
     */
    protected $picture;

    /**
     * @var Banque
     *
     * @ORM\ManyToMany(targetEntity="\App\BanqueBundle\Entity\Banque")
     * @ORM\JoinTable(name="user_banque",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="banque_id", referencedColumnName="id")}
     *      )
     */
    protected $banque;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFacebookID()
    {
        return $this->facebookID;
    }

    /**
     * @param string $facebookID
     */
    public function setFacebookID($facebookID)
    {
        $this->facebookID = $facebookID;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * @param string $facebook_access_token
     */
    public function setFacebookAccessToken($facebook_access_token)
    {
        $this->facebook_access_token = $facebook_access_token;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return true;
    }

    /**
     * Add banque
     *
     * @param \Core\UserBundle\Entity\User $banque
     *
     * @return User
     */
    public function addBanque(\Core\UserBundle\Entity\User $banque)
    {
        $this->banque[] = $banque;

        return $this;
    }

    /**
     * Remove banque
     *
     * @param \Core\UserBundle\Entity\User $banque
     */
    public function removeBanque(\Core\UserBundle\Entity\User $banque)
    {
        $this->banque->removeElement($banque);
    }

    /**
     * Get banque
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBanque()
    {
        return $this->banque;
    }
}

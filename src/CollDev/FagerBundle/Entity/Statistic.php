<?php

namespace CollDev\FagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistic
 *
 * @ORM\Table(name="fager_statistic")
 * @ORM\Entity(repositoryClass="CollDev\FagerBundle\Entity\StatisticRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Statistic
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=false)
     */
    private $ip;

    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="integer", nullable=false)
     */
    private $total;

    /**
     * @var integer
     *
     * @ORM\Column(name="keystrokes", type="integer", nullable=false)
     */
    private $keystrokes;

    /**
     * @var integer
     *
     * @ORM\Column(name="correct", type="integer", nullable=false)
     */
    private $correct;

    /**
     * @var integer
     *
     * @ORM\Column(name="wrong", type="integer", nullable=false)
     */
    private $wrong;

    /**
     * @var integer
     *
     * @ORM\Column(name="elapsed_time", type="integer", nullable=false)
     */
    private $elapsedTime;

    /**
     * @var string
     *
     * @ORM\Column(name="user_input", type="text", nullable=false)
     */
    private $userInput;

    /**
     * @var integer
     *
     * @ORM\Column(name="mistakes", type="integer", nullable=false)
     */
    private $mistakes;

    /**
     * @var integer
     *
     * @ORM\Column(name="goodies", type="integer", nullable=false)
     */
    private $goodies;

    /**
     * @var integer
     *
     * @ORM\Column(name="backspace_counter", type="integer", nullable=false)
     */
    private $backspaceCounter;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Statistic
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    
        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set total
     *
     * @param integer $total
     * @return Statistic
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return integer 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set keystrokes
     *
     * @param integer $keystrokes
     * @return Statistic
     */
    public function setKeystrokes($keystrokes)
    {
        $this->keystrokes = $keystrokes;
    
        return $this;
    }

    /**
     * Get keystrokes
     *
     * @return integer 
     */
    public function getKeystrokes()
    {
        return $this->keystrokes;
    }

    /**
     * Set correct
     *
     * @param integer $correct
     * @return Statistic
     */
    public function setCorrect($correct)
    {
        $this->correct = $correct;
    
        return $this;
    }

    /**
     * Get correct
     *
     * @return integer 
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    /**
     * Set wrong
     *
     * @param integer $wrong
     * @return Statistic
     */
    public function setWrong($wrong)
    {
        $this->wrong = $wrong;
    
        return $this;
    }

    /**
     * Get wrong
     *
     * @return integer 
     */
    public function getWrong()
    {
        return $this->wrong;
    }

    /**
     * Set elapsedTime
     *
     * @param integer $elapsedTime
     * @return Statistic
     */
    public function setElapsedTime($elapsedTime)
    {
        $this->elapsedTime = $elapsedTime;
    
        return $this;
    }

    /**
     * Get elapsedTime
     *
     * @return integer 
     */
    public function getElapsedTime()
    {
        return $this->elapsedTime;
    }

    /**
     * Set userInput
     *
     * @param string $userInput
     * @return Statistic
     */
    public function setUserInput($userInput)
    {
        $this->userInput = $userInput;
    
        return $this;
    }

    /**
     * Get userInput
     *
     * @return string 
     */
    public function getUserInput()
    {
        return $this->userInput;
    }

    /**
     * Set mistakes
     *
     * @param integer $mistakes
     * @return Statistic
     */
    public function setMistakes($mistakes)
    {
        $this->mistakes = $mistakes;
    
        return $this;
    }

    /**
     * Get mistakes
     *
     * @return integer 
     */
    public function getMistakes()
    {
        return $this->mistakes;
    }

    /**
     * Set goodies
     *
     * @param integer $goodies
     * @return Statistic
     */
    public function setGoodies($goodies)
    {
        $this->goodies = $goodies;
    
        return $this;
    }

    /**
     * Get goodies
     *
     * @return integer 
     */
    public function getGoodies()
    {
        return $this->goodies;
    }

    /**
     * Set backspaceCounter
     *
     * @param integer $backspaceCounter
     * @return Statistic
     */
    public function setBackspaceCounter($backspaceCounter)
    {
        $this->backspaceCounter = $backspaceCounter;
    
        return $this;
    }

    /**
     * Get backspaceCounter
     *
     * @return integer 
     */
    public function getBackspaceCounter()
    {
        return $this->backspaceCounter;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Statistic
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }
    
    /**
     * Execute some tasks previous persist
     * 
     * @ORM\PrePersist()
     */
    public function prePersistTasks() {
	$this->created = new \DateTime();
    }
}

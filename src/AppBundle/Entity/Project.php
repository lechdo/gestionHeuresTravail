<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="githubLink", type="string", length=1500, nullable=true)
     */
    private $githubLink;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Task", mappedBy="project")
     */
    private $tasks;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Language", mappedBy="project")
     */
    private $languages;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Framework", mappedBy="project")
     */
    private $frameworks;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SuperProject", inversedBy="projects")
     */
    private $superProject;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ide", mappedBy="project")
     */
    private $ides;

    /**
     * @return mixed
     */
    public function getIdes()
    {
        return $this->ides;
    }

    /**
     * @param mixed $ides
     */
    public function setIdes($ides)
    {
        $this->ides = $ides;
    }

    /**
     * @return mixed
     */
    public function getSuperProject()
    {
        return $this->superProject;
    }

    /**
     * @param mixed $superProject
     */
    public function setSuperProject($superProject)
    {
        $this->superProject = $superProject;
    }



    /**
     * @return mixed
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param mixed $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param mixed $languages
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return mixed
     */
    public function getFrameworks()
    {
        return $this->frameworks;
    }

    /**
     * @param mixed $frameworks
     */
    public function setFrameworks($frameworks)
    {
        $this->frameworks = $frameworks;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Project
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set githubLink
     *
     * @param string $githubLink
     *
     * @return Project
     */
    public function setGithubLink($githubLink)
    {
        $this->githubLink = $githubLink;

        return $this;
    }

    /**
     * Get githubLink
     *
     * @return string
     */
    public function getGithubLink()
    {
        return $this->githubLink;
    }
}


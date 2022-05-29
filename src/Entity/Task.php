<?php 
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Task {
    /**
     * @Assert\NotBlank(message="El nombre de la tarea es obligatorio")
     */
    protected $task;
    /**
     * @Assert\NotBlank
     * @Assert\Type("\DateTime")
     */
    protected $dueDate;

    protected $tipo;

    // constructor…
    public function __construct($task="", \DateTime $dueDate=null) {
        $this->task = $task;
        $this->dueDate = $dueDate;
    }

    // getter & setters
    public function setTask($task){
        $this->task = $task;
    }
    public function getTask(){
        return $this->task;
    }
    
    public function setDueDate(\DateTime $dueDate){
        $this->dueDate = $dueDate;
    }
    public function getDueDate():\DateTime {
        return $this->dueDate;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    public function getTipo() {
        return $this->tipo;
    }
}
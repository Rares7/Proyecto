<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends AbstractController
{
    /**
     * @Route("/task", name="app_task")
     */
    public function index(Request $request): Response
    {

        //1. Los datos que van a estar en el formulario por defecto + la estructura
        $task = new Task("Tarea 1", new \DateTime('tomorrow'));

        //2. La generación de la configuración del formulario
        $form = $this->createFormBuilder($task)
            ->setMethod("GET")
            ->add('task', TextType::class, ['label' => 'Nueva tarea', 'required'=>false])
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        // //Syntaxis equivalente
        // $formbuilder = $this->createFormBuilder($task);
        // $formbuilder->add('task', TextType::class);
        // $formbuilder->add('dueDate', DateType::class);
        // $formbuilder->add('save', SubmitType::class, ['label' => 'Create Task']);
        // $form = $formbuilder->getForm();


        //4. Recibir el envío del formulario (cuando el action esta por defecto, se envía al mismo controlador que lo pinta)
        //Buscar en $_GET o $_POST si tenemos los input y el submit del formulario
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //El getData se hace en automatico y su objetivo es actualizar la entidad con los datos de $_GET o $_POST
            $task = $form->getData();
            // ... TODO do anything
            //return $this->redirectToRoute('task_success');
        }
        

        $form2 = $this->createForm(TaskType::class, $task, ['show_due_date' => true, 'label_save'=>"Crear"]);
        $form2->get('agreeTerms')->setData(true);

        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) {
            //El getData se hace en automatico y su objetivo es actualizar la entidad con los datos de $_GET o $_POST
            $task = $form2->getData();
            $agreeTerms = $form->get('agreeTerms')->getData();
            // ... TODO do anything
            //return $this->redirectToRoute('task_success');
        }


        //3. Enviar el createView a la vista
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
            'myForm' => $form->createView(),
            'myForm2' => $form2->createView()
        ]);
    }
}

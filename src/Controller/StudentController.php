<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine ->getRepository(Student::class);
        $students = $repo->findAll();
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
            'students'=> $students
        ]);
    }

  

    #[Route('/deleteStudent/{id}', name: 'Student_delete')]
    public function deleteClassroom($id, StudentRepository $repo)
    {
        $Student = $repo->find($id);
        $repo->remove($Student, true);
       return $this->redirectToRoute('app_student');
        
    }

    #[Route('/addStudent', name: 'Student_add')]
    public function addStudent( StudentRepository $repo, ManagerRegistry $doctrine)
    {
        $student = new Student();
        $student->setNSC('14523');
        $student->setEmail('SIRINE@esprit.tn');
        $entitymanager = $doctrine->getManager();
        $entitymanager->persist($student);
        $entitymanager->flush();
       return $this->redirectToRoute('app_student');
        
    }

    #[Route('/UpdateStudent/{id}', name: 'student_Update')]
    public function UpdateStudent($id, StudentRepository $repo, ManagerRegistry $doctrine)
    {
        $student = $repo->find($id);
        $student->setNSC('Student updated');
        $entitymanager = $doctrine->getManager();
        $entitymanager->flush();
       return $this->redirectToRoute('app_student');
        
    }


}


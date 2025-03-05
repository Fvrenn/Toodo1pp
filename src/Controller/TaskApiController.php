<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/tasks', name: 'api_task_')]
class TaskApiController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(TaskRepository $taskRepository, Request $request): JsonResponse
    {
        $filter = $request->query->get('filter', 'all');
        
        $tasks = match ($filter) {
            'pending' => $taskRepository->findBy(['status' => false]),
            'completed' => $taskRepository->findBy(['status' => true]),
            default => $taskRepository->findAll(),
        };

        return $this->json([
            'tasks' => $tasks,
        ], Response::HTTP_OK, [], ['groups' => 'task:read']);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Task $task): JsonResponse
    {
        return $this->json([
            'task' => $task,
        ], Response::HTTP_OK, [], ['groups' => 'task:read']);
    }
    
    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        try {
            $jsonData = $request->getContent();
            
            $task = $serializer->deserialize($jsonData, Task::class, 'json');
            
            if (!$task->getCreatedAt()) {
                $task->setCreatedAt(new \DateTime());
            }
            
            $entityManager->persist($task);
            $entityManager->flush();
            
            return $this->json([
                'status' => 'success',
                'message' => 'Tâche créée avec succès',
                'task' => $task
            ], Response::HTTP_CREATED, [], ['groups' => 'task:read']);
            
        } catch (\Exception $e) {
            return $this->json([
                'status' => 'error',
                'message' => 'Erreur lors de la création de la tâche : ' . $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
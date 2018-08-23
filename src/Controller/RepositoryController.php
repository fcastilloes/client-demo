<?php

namespace App\Controller;

use App\Entity\Chart;
use App\Form\ChartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RepositoryController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function testRepository(
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        $chart =new Chart();
        $chart->setRepo('fc');

        $errors = $validator->validate($chart);
        if (count($errors) > 0) {
            $errorString = (string) $errors;

            return new Response($errorString);
        }

        /** @var Chart $chart */
        $chart = $this->getDoctrine()
            ->getRepository(Chart::class)
            ->findAll()
        ;

        $response = $chart;

        return new Response(
            $serializer->serialize($response, 'json',[
                'groups' => ['test']
            ]), 200, [
                'Content-Type' => 'application/json',
            ]
        );
    }

    /**
     * @Route("/repository/{owner}/{repo}", name="repository")
     */
    public function showRepository(Request $request, $owner, $repo)
    {
        $chart = new Chart();
        $chart->setRepo("$owner/$repo");

        $form = $this->createForm(ChartType::class, $chart);
        $form->add('save', SubmitType::class, [
            'label' => 'Nuevo Chart',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chart = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chart);
            $entityManager->flush();

            return $this->redirectToRoute('test');
        }

        return $this->render('repository/show.html.twig', [
            'owner' => $owner,
            'repo' => $repo,
            'issues' => $this->getMockIssues(),
            'form' => $form->createView(),
        ]);
    }

    private function getMockIssues()
    {
        return [
            [
                "id" => 1,
                "state" => "open",
                "title" => "Found a bug",
                "body" => "I'm having a problem with this.",
                "labels" => [
                    [
                        "name" => "bug",
                        "description" => "Houston, we have a problem",
                        "color" => "f29513",
                        "default" => true
                    ]
                ],
                "comments" => 0,
                "closed_at" => null,
                "created_at" => "2018-08-12T13:33:48Z",
                "updated_at" => "2018-08-12T13:33:48Z"
            ],
            [
                "id" => 2,
                "state" => "open",
                "title" => "Something broke",
                "body" => "I'm having a problem with this.",
                "labels" => [
                    [
                        "name" => "bug",
                        "description" => "Houston, we have a problem",
                        "color" => "f29513",
                        "default" => true
                    ]
                ],
                "comments" => 0,
                "closed_at" => null,
                "created_at" => "2018-08-18T13:33:48Z",
                "updated_at" => "2018-08-18T13:33:48Z"
            ],
            [
                "id" => 3,
                "state" => "open",
                "title" => "This is a pull request",
                "body" => "",
                "labels" => [
                    [
                        "name" => "bug",
                        "description" => "Houston, we have a problem",
                        "color" => "f29513",
                        "default" => true
                    ]
                ],
                "comments" => 0,
                "closed_at" => null,
                "created_at" => "2018-08-22T13:33:48Z",
                "updated_at" => "2018-08-22T13:33:48Z",
                "pull_request" => [],
            ],
        ];
    }
}

<?php

namespace App\Controller;

use App\Exceptions\WrongValue;
use App\Services\RangeService;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RangeController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    private RangeService $service;

    public function __construct(RangeService $service)
    {
        $this->service = $service;
    }

    #[Route('/find_range', name: 'find_range')]
    public function index(Request $request): Response
    {
        $form = $this->rangeForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $number = $this->tryNumber(($form->getData())['number']);
                $rangeId = $this->service->rangeIdByNumber($number);

                if (!$rangeId) {
                    $form->addError(new FormError('Number is not in a range'));
                }
            } catch (WrongValue $exception) {
                $form->addError(new FormError($exception->getMessage()));
            }
        }

        return $this->render('range.html.twig', [
            'form' => $form,
            'rangeId' => $rangeId ?? null
        ]);
    }

    /**
     * @param string $value
     * @return int
     * @throws WrongValue
     */
    private function tryNumber(string $value): int
    {
        $mustBeInteger = trim($value);

        if (preg_match('/^-?\d+$/', $mustBeInteger)) {

            if ($mustBeInteger > PHP_INT_MAX) {
                throw new WrongValue('Number is too long');
            }
            return (int)$mustBeInteger;
        }

        throw new WrongValue('Is not a number');
    }

    /**
     * @return FormInterface
     */
    private function rangeForm(): \Symfony\Component\Form\FormInterface
    {
        return $this->createFormBuilder()
            ->add('number',
                TextType::class,
                ['row_attr' => ['class' => 'form-floating']])
            ->add('submit',
                SubmitType::class,
                [
                    'label' => 'Get range ID',
                    'row_attr' => ['class' => 'btn btn-primary mb-3']
                ]
            )->getForm();
    }
}

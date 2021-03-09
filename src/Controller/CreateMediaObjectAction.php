<?php

namespace App\Controller;

use App\Entity\MediaObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Repository\ProductRepository;

final class CreateMediaObjectAction extends AbstractController
{
    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function __invoke(Request $request): MediaObject
    {
        $uploadedFile = $request->files->get('file');
        $productId = $request->query->get('productId');

        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        if (!$productId) {
            throw new BadRequestHttpException('"productId" is required');
        }

        $mediaObject = new MediaObject();
        $mediaObject->file = $uploadedFile;

        $product = $this->productRepository->findOneBy(['id' => $productId]);
        $mediaObject->setProduct($product);

        return $mediaObject;
    }
}

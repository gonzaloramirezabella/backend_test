<?php 
namespace App\Controller;

use App\Repository\QuotesJsonRepository;
use App\Service\ShoutService;
use Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Example;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ShoutController extends AbstractController{
    protected $shoutService;
    protected $quotesRepository;
    private const MAX_LIMIT_PARAMETER = 10;

    public function __construct(ShoutService $shoutService, QuotesJsonRepository $quotesJsonRepository){
        $this->shoutService = $shoutService;
        $this->quotesRepository = $quotesJsonRepository;
    }

    /**
     * @Route("/shout/{author}", methods={"GET"})
     */
    public function shout(Request $request, $author){     
        try {
            $limit = $request->get('limit');        
            $this->validateParams($limit);
            $quotes = $this->getQoutesAndShout($author, $limit);            
            return $this->createJsonResponse($quotes, 200);            
        } catch (Exception $e) {
            return $this->createJsonResponse($e->getMessage(), 400);
        }        
    }

    private function getQoutesAndShout($author, $limit){
        $quotes = $this->quotesRepository->get($author, $limit);
        foreach ($quotes as $k => $quote){
            $quotes[$k] = $this->shoutService->shouted($quote);
        }
        return $quotes;
    }

    private function createJsonResponse($content, $code){
        $jsonResponse = new JsonResponse($content, $code);
        $jsonResponse->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        return $jsonResponse;
    }

    private function validateParams($limit){
        if ($limit >= self::MAX_LIMIT_PARAMETER){            
            throw new Exception("The limit must be less or equal than " . self::MAX_LIMIT_PARAMETER);
        }
    }
}
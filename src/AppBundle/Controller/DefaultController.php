<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Url;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // create a new url object
        $url = new Url();

        $form = $this->createFormBuilder($url)
            ->add('url', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Generate short url'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $url = $form->getData();
            $urlService = $this->get('app.url_service');
            $shortUrl = $urlService->generateUrl($url);

            if(!empty($shortUrl)) {
                $this->addFlash('url', $shortUrl);
                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render('default/home.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{slug}")
     */
    public function urlAction($slug)
    {
        $urlService = $this->get('app.url_service');
        $shortUrl = $urlService->getUrl($slug);

        if(!empty($shortUrl)){
            return new RedirectResponse($shortUrl);
        }

        throw new NotFoundHttpException('Sorry that route does not exist');

    }
}

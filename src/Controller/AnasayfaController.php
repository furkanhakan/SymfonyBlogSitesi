<?php

namespace App\Controller;

use App\Entity\Mesajlar;
use App\Entity\Yorumlar;
use App\Form\MesajlarType;
use App\Form\YorumlarType;
use App\Repository\GonderiRepository;
use App\Repository\MesajlarRepository;
use App\Repository\YorumlarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnasayfaController extends AbstractController
{
    /**
     * @Route("/", name="anasayfa")
     */
    public function index(GonderiRepository $gonderiRepository,YorumlarRepository $yorumlarRepository)
    {
        $sinir = 3;
        $baslangic = 0;
        $sayfa = 1;

        return $this->render('anasayfa/index.html.twig', [
            'controller_name' => 'AnasayfaController',
            'gonderi' => $gonderiRepository->sondanvericek($sinir,$baslangic),
            'yorumlar' =>$yorumlarRepository->yorumlar(),
            'populer' => $yorumlarRepository->populer(),
            'gonderiler' => $gonderiRepository->findAll(),
            'gonderisayfa' => $gonderiRepository->sayfalama($sayfa),
            'kategoriler' => $gonderiRepository->kategoriler(),
        ]);
    }

    /**
     * @Route("/sayfa/{sayfa}", name="sayfalama")
     */
    public function sayfalama(GonderiRepository $gonderiRepository,$sayfa,YorumlarRepository $yorumlarRepository)
    {
        $sinir = 3;
        $baslangic = 0;
        if($sayfa == 1){
            return $this->redirectToRoute('anasayfa');
        }

        return $this->render('anasayfa/sayfa.html.twig', [
            'controller_name' => 'AnasayfaController',
            'populer' => $yorumlarRepository->populer(),
            'gonderi' => $gonderiRepository->sondanvericek($sinir,$baslangic),
            'yorumlar' =>$yorumlarRepository->yorumlar(),
            'gonderiler' => $gonderiRepository->findAll(),
            'gonderisayfa' => $gonderiRepository->sayfalama($sayfa),
            'sayfa' => $sayfa,
            'kategoriler' => $gonderiRepository->kategoriler(),
        ]);
    }

    /**
     * @Route("/post/{gonderibasligi}", name="gonderidetay")
     */
    public function gonderidetay(GonderiRepository $gonderiRepository,$gonderibasligi,YorumlarRepository $yorumlarRepository,Request $request):Response
    {
        $yorumlar = new Yorumlar();
        $form = $this->createForm(YorumlarType::class , $yorumlar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($yorumlar);
            $yorumlar->setYorumtarihi(date('d-m-Y H:i:s',time() + 7200));
            if (strtoupper($yorumlar->getYorumadi()) == 'ADMIN'){
                $this->addFlash('hata','Admin ismi ile yorum atamazsınız');
                return $this->redirectToRoute('gonderidetay',array('gonderibasligi'=>$gonderibasligi));
            }

            $entityManager->flush();

            return $this->redirectToRoute('gonderidetay',array('gonderibasligi'=>$gonderibasligi));
        }
        $gonderibasligi = str_replace('-',' ',$gonderibasligi);
        $id = $gonderiRepository->findOneBy(['gonderibasligi' =>$gonderibasligi])->getId();
        return $this->render('anasayfa/gonderidetay.html.twig', [
            'controller_name' => 'AnasayfaController',
            'populer' => $yorumlarRepository->populer(),
            'yorumlar' => $yorumlarRepository->findBy(['yorumid' => $id],['yorumtarihi'=>'DESC']),
            'gonderi' => $gonderiRepository->findOneBy(['gonderibasligi' =>$gonderibasligi]),
            'gonderiler' => $gonderiRepository->findAll(),
            'kategoriler' => $gonderiRepository->kategoriler(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/hakkimda", name="hakkimda")
     */
    public function hakkimda(GonderiRepository $gonderiRepository,YorumlarRepository $yorumlarRepository)
    {
        return $this->render('anasayfa/hakkimda.html.twig', [
            'kategoriler' => $gonderiRepository->kategoriler(),
            'gonderiler' => $gonderiRepository->findAll(),
            'populer' => $yorumlarRepository->populer(),
        ]);
    }

    /**
     * @Route("/iletisim", name="iletisim")
     */
    public function iletisim(GonderiRepository $gonderiRepository,YorumlarRepository $yorumlarRepository,Request $request):Response
    {
        $mesajlar = new Mesajlar();
        $form = $this->createForm(MesajlarType::class , $mesajlar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mesajlar);
            $entityManager->flush();
            return $this->redirectToRoute('iletisim');
        }
        return $this->render('anasayfa/iletisim.html.twig', [
            'kategoriler' => $gonderiRepository->kategoriler(),
            'gonderiler' => $gonderiRepository->findAll(),
            'populer' => $yorumlarRepository->populer(),
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/kategori/{kategori}/{sayfa}", name="kategori")
     */
    public function kategori(GonderiRepository $gonderiRepository,$kategori,$sayfa,YorumlarRepository $yorumlarRepository)
    {
        $kategori = str_replace('-', ' ', $kategori);
        return $this->render('anasayfa/kategori.html.twig', [
            'yorumlar' =>$yorumlarRepository->yorumlar(),
            'kategoriler' => $gonderiRepository->kategoriler(),
            'sayfa' => $sayfa,
            'populer' => $yorumlarRepository->populer(),
            'sinirligonderi' => $gonderiRepository->createQueryBuilder('k')
                ->andWhere('k.kategori = :kategori')
                ->setParameter('kategori' , $kategori)
                ->setMaxResults(8)
                ->setFirstResult(((8 * $sayfa)-8))
                ->orderBy('k.gonderitarihi','DESC')
                ->getQuery()
                ->getResult(),
            'tumgonderiler' => $gonderiRepository->createQueryBuilder('k')
                ->andWhere('k.kategori = :kategori')
                ->setParameter('kategori' , $kategori)
                ->getQuery()
                ->getResult(),
            'gonderiler' => $gonderiRepository->findAll(),
        ]);
    }
}

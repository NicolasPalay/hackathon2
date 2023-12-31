<?php

namespace App\Controller;

use App\Entity\Device;
use App\Form\DeviceType;
use App\Form\SearchType;
use App\Repository\DeviceRepository;
use App\Search\SearchData;
use App\Services\PriceDevice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/device')]
class DeviceController extends AbstractController
{
    /*#[Route('/', name: 'app_device_index', methods: ['GET'])]
    public function index(DeviceRepository $deviceRepository): Response
    {

        return $this->render('device/index.html.twig', [
            'devices' => $deviceRepository->findAll(),



        ]);
    }*/

    #[Route('/new', name: 'app_device_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DeviceRepository $deviceRepository, PriceDevice $Pricedevice): Response
    {
        $device = new Device();
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $device->setPrice($Pricedevice->calculate($device));
            $deviceRepository->save($device, true);

            return $this->redirectToRoute('app_device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('device/new.html.twig', [
            'device' => $device,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_device_show', methods: ['GET'])]
    public function show(Device $device, PriceDevice $Pricedevice): Response
    {
        return $this->render('device/show.html.twig', [
            'device' => $device,
            'price' => $Pricedevice->calculate($device)
        ]);
    }

    #[Route('/{id}/edit', name: 'app_device_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Device $device, DeviceRepository $deviceRepository): Response
    {
        $form = $this->createForm(DeviceType::class, $device);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deviceRepository->save($device, true);

            return $this->redirectToRoute('app_device_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('device/edit.html.twig', [
            'device' => $device,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_device_delete', methods: ['POST'])]
    public function delete(Request $request, Device $device, DeviceRepository $deviceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$device->getId(), $request->request->get('_token'))) {
            $deviceRepository->remove($device, true);
        }

        return $this->redirectToRoute('app_device_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/', name: 'device')]
    public function showAllDevices(DeviceRepository $deviceRepository, Request $request): Response
    {
        $data = new SearchData();
        $data->page= $request->get('page', 1);

        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);
        $devices = $deviceRepository->findSearch($data);
        return $this->render('device/index.html.twig', [
            'devices' => $devices,
            'form' => $form->createView()
        ]);
    }

}

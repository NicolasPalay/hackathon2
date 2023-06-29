<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Entity\Camera;
use App\Entity\Device;
use App\Entity\Memory;
use App\Entity\SizeScreen;
use App\Entity\State;
use App\Entity\Storage;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(DeviceCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hakathon2');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('Devices', 'fa fa-computer', Device::class);
        yield MenuItem::linkToCrud('Brands', 'fa fa-copyright', Brand::class);
        yield MenuItem::linkToCrud('Cameras', 'fa fa-camera-retro', Camera::class);
        yield MenuItem::linkToCrud('Memories', 'fa fa-memory', Memory::class);
        yield MenuItem::linkToCrud('Size of screens', 'fa fa-minimize', SizeScreen::class);
        yield MenuItem::linkToCrud('States', 'fa fa-hand-sparkles', State::class);
        yield MenuItem::linkToCrud('Storages', 'fa fa-hard-drive', Storage::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-circle-user', User::class);
    }
}

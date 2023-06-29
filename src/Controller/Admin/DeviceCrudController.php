<?php

namespace App\Controller\Admin;

use App\Entity\Device;
use App\Entity\Storage;
use App\Services\PriceDevice;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;



class DeviceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Device::class;
    }
    private $priceDevice;

    public function __construct(PriceDevice $priceDevice)
    {
        $this->priceDevice = $priceDevice;

    }

    public function saveEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->calculatePrice($entityInstance);

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    private function calculatePrice(Device $device): void
    {
        $price = $this->priceDevice->calculate($device);
        $device->setPrice($price);
    }

    public function configureFields(string $pageName): iterable
    {

        return [

            TextField::new('name'),
            ImageField::new('image')
               ->setBasePath('build/images')
                ->setUploadDir('assets/images'),
            IntegerField::new('stock'),
            AssociationField::new('memory'),
            AssociationField::new('storage'),
            AssociationField::new('sizeScreen'),
            AssociationField::new('camera'),
            AssociationField::new('state'),

            AssociationField::new('brand'),
             NumberField::new('price', 'Prix')->onlyOnIndex()
         ->formatValue(function ($value, $entity) {
                // Appel de la fonction de l'entité pour calculer le prix
                $price = $this->priceDevice->calculate($entity);
                $entity->setPrice($price);


                // Formatage et affichage du prix
                return sprintf('%s €', $price);



            }),
        ];




    }

}

<?php

namespace App\Controller\Cpanel;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield TextField::new('code');
        yield TextField::new('barcode');
        yield TextEditorField::new('description');
        yield ArrayField::new('characteristics');
        yield ArrayField::new('photos');
//        yield FieldCollection::new('productCategory');
    }

}

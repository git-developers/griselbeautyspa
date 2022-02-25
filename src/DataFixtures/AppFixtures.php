<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Profile;
use App\Entity\Xservice;
use App\Entity\Product;
use App\Entity\XserviceCategory;
use App\Entity\ProductCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // ==================================
        $o1 = new XserviceCategory();
        $o1->setName("Service Category 1");
        $manager->persist($o1);

        $o2 = new XserviceCategory();
        $o2->setName("Service Category 2");
        $manager->persist($o2);

        $o = new Xservice();
        $o->setName("Service 1");
        $o->setPrice(11);
        $o->setIsActive(true);
        $o->setXServiceCategory($o1);
        $manager->persist($o);

        $o = new Xservice();
        $o->setName("Service 2");
        $o->setPrice(22);
        $o->setIsActive(true);
        $o->setXServiceCategory($o2);
        $manager->persist($o);


        // ==================================
        $o1 = new ProductCategory();
        $o1->setName("Product Category 1");
        $manager->persist($o1);

        $o2 = new ProductCategory();
        $o2->setName("Product Category 2");
        $manager->persist($o2);

        $o = new Product();
        $o->setName("Product 1");
        $o->setPrice(11);
        $o->setIsActive(true);
        $o->setProductCategory($o1);
        $manager->persist($o);

        $o = new Product();
        $o->setName("Product 2");
        $o->setPrice(22);
        $o->setIsActive(true);
        $o->setProductCategory($o2);
        $manager->persist($o);


        // ==================================
        $o1 = new Profile();
        $o1->setCode(Profile::CUSTOMER);
        $o1->setName(Profile::CUSTOMER);
        $manager->persist($o1);

        $o2 = new Profile();
        $o2->setCode(Profile::STAFF_MEMBER);
        $o2->setName(Profile::STAFF_MEMBER);
        $manager->persist($o2);


        // ==================================
        $roles = [];
        $roles[] = 'ROLE_USER';

        $o = new User();
        $o->setName("Customer 1");
        $o->setLastName("LastName 1");
        $o->setEmail("customer-1@griselbeautyspa.com");
        $o->setPassword("111");
        $o->setProfile($o1);
        $o->setRoles($roles);
        $manager->persist($o);

        $o = new User();
        $o->setName("Customer 2");
        $o->setLastName("LastName 2");
        $o->setEmail("customer-2@griselbeautyspa.com");
        $o->setPassword("222");
        $o->setProfile($o1);
        $o->setRoles($roles);
        $manager->persist($o);


        // ==================================
        $o = new User();
        $o->setName("Staff Member 1");
        $o->setLastName("LastName 1");
        $o->setEmail("staff-member-1@griselbeautyspa.com");
        $o->setPassword("111");
        $o->setProfile($o2);
        $o->setRoles($roles);
        $manager->persist($o);

        $o = new User();
        $o->setName("Staff Member 2");
        $o->setLastName("LastName 2");
        $o->setEmail("staff-member-2@griselbeautyspa.com");
        $o->setPassword("222");
        $o->setProfile($o2);
        $o->setRoles($roles);
        $manager->persist($o);



        $manager->flush();
    }
}

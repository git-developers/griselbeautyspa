<?php

namespace App\EventListener;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Xservice;
use App\Entity\Appointment;
use App\Entity\ProductCategory;
use App\Entity\XserviceCategory;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\AsciiSlugger;

class DatabaseActivitySubscriber implements EventSubscriber
{
    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }

    // callback methods must be called exactly like the events they listen to;
    // they receive an argument of type LifecycleEventArgs, which gives you access
    // to both the entity object of the event and the entity manager itself

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Product) {

            $slugger = new AsciiSlugger();
            $name = strtolower($entity->getName());
            $code = $slugger->slug($name);
            $entity->setCode($code);
            $entity->setIsEnabled(true);

            return;
        }

        if ($entity instanceof ProductCategory) {

            $slugger = new AsciiSlugger();
            $name = strtolower($entity->getName());
            $code = $slugger->slug($name);
            $entity->setCode($code);

            return;
        }

        if ($entity instanceof XserviceCategory) {

            $slugger = new AsciiSlugger();
            $name = strtolower($entity->getName());
            $code = $slugger->slug($name);
            $entity->setCode($code);

            return;
        }

        if ($entity instanceof Xservice) {

            $slugger = new AsciiSlugger();
            $name = strtolower($entity->getName());
            $code = $slugger->slug($name);
            $entity->setCode($code);
            $entity->setIsEnabled(true);

            return;
        }

        if ($entity instanceof User) {

            $entity->setIsActive(true);
            $entity->setIsEnabled(true);

            return;
        }

        if ($entity instanceof Appointment) {

            $entity->setCode(uniqid());
            $entity->setIsEnabled(true);

            return;
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Product) {

            $slugger = new AsciiSlugger();
            $name = strtolower($entity->getName());
            $code = $slugger->slug($name);
            $entity->setCode($code);

            return;
        }

        if ($entity instanceof ProductCategory) {

            $slugger = new AsciiSlugger();
            $name = strtolower($entity->getName());
            $code = $slugger->slug($name);
            $entity->setCode($code);

            return;
        }

        if ($entity instanceof XserviceCategory) {

            $slugger = new AsciiSlugger();
            $name = strtolower($entity->getName());
            $code = $slugger->slug($name);
            $entity->setCode($code);

            return;
        }

        if ($entity instanceof Xservice) {

            $slugger = new AsciiSlugger();
            $name = strtolower($entity->getName());
            $code = $slugger->slug($name);
            $entity->setCode($code);

            return;
        }

        if ($entity instanceof Appointment) {

            return;
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->logActivity('persist', $args);
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $this->logActivity('remove', $args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->logActivity('update', $args);
    }

    private function logActivity(string $action, LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // if this subscriber only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof Product) {
            return;
        }

        // ... get the entity information and log it somehow
    }
}
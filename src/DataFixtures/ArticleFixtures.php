<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Amis;
use App\Entity\Article;
use App\Entity\Comment;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        // creer 10 article ,user, comment
          for($i = 1; $i <=10; $i++){

            $article = new Article();
            $article ->setRace($faker->country())
                      ->setFamille($faker->sentence())
                      ->setNourriture($faker->imageUrl())
                      ->setAge(mt_rand(10,50));


                    $manager->persist($article);

          $user = new User();

          $user ->setPassword($faker->password())
                ->setEmail($faker->email())
                ->setUsername($faker->userName());

                $manager->persist($user);


                  // fait 100 amis related user
                  // fait 100 commentaire related article
                  for($i = 1; $i <=10; $i++){
                       $amis = new Amis();
                       $amis->setPrenom($faker->name())
                            ->setAge(mt_rand(10,50))
                            ->setLocation($faker->address())
                            ->addAmi($user);

                            $manager->persist($amis);
                            // $content = '<p>' . join($faker->paragraph(), '<p></p>') . '</p>';

                       $comment = new Comment();
                       $comment->setAuthor($faker->name())
                               ->setContent($faker->paragraph());
                               // ->setCreatat(new \DateTime());
                             $manager->persist($comment);
        }


  }
  $manager->flush();
}
}

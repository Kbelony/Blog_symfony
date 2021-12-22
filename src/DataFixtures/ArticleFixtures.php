<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 10; $i++){
            $article = new Article();
            $article->setTitle("Titre de l'article n°$i")
                    ->setArticlesText("Contenu article n°$i")
                    ->setAuthorName("George")
                    ->setAuthorId(2)
                    ->setCreatedAt(new \DateTime())
                    ->setSlug("test");

            $manager->persist($article);
        }
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Comment;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        //Creer categorie
        for ($i = 1; $i <= 10; $i++) {
            $category = new Category();
            $category->setTitle($faker->sentence(1))
                    ->setDescription($faker->paragraph());
            
            $manager->persist($category);

        //Creer entre 4 et 6 articles
        for($j = 1; $j <= 5; $j++){
            $article = new Article();
            //$content = '<p>' . join($faker->pragraphs(5), '</p><p>').'</p>';

            $article->setTitle($faker->sentence())
                    ->setArticlesText("Contenu article n°$i")
                    ->setAuthorName($faker->firstNameMale())
                    ->setImage($faker->imageUrl())
                    ->setSummary($faker->paragraphs(3))
                    ->setAuthorId($faker->randomDigitNotNull())
                    ->setCreatedAt($faker->dateTimeBetween('-2 months'))
                    ->setSlug($faker->sentence())
                    ->setCategory($category);

            $manager->persist($article);
        }
        //Creer commentaire 
        for($k = 1; $k <= mt_rand(4, 10); $k++){
            $comment = new Comment();
            $now = new \DateTime();
            $days = $now->diff($article->getCreatedAt())->days;
            $minimum = '-'. $days. 'days';
            $comment->setAuthor($faker->name)
                    ->setContent($faker->paragraphs(2))
                    ->setCreatedAt($faker->dateTimeBetween($minimum))
                    ->setArticle(($article));
            
            $manager->persist($comment);
        }
        }
        $manager->flush();
    }
}

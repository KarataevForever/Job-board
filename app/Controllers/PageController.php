<?php
namespace App\Controllers;

use ORM;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\PhpRenderer;

class PageController
{
    public function index(Request $request, Response $response, $args)
    {
        $renderer = new PhpRenderer('resources');

        $jobs = ORM::for_table('')->raw_query("
    SELECT jobs.id as jobs_id, title, citys, countries, job_natures, published
    FROM jobs
    JOIN city on city.id = jobs.city 
    JOIN job_nature ON job_nature.id = jobs.job_nature 
    JOIN country ON country.id = city.country")->find_many();

        $job_listed = ORM::forTable('jobs')->raw_query("SELECT SUM(vacancy_tally) as sum FROM jobs")->find_one();

        $categories = ORM::for_table('categories')->raw_query("SELECT SUM(jobs.vacancy_tally) as sum, jobs.category, category.categories
    FROM jobs
    JOIN category ON category.id = jobs.category
    GROUP BY category
    ORDER BY sum DESC limit 8")->findMany();

        $parameters_cities = ORM::for_table('jobs')->raw_query("SELECT city.id, city.citys FROM jobs 
                                                            JOIN city ON city.id = jobs.city GROUP BY city")->find_many();

        $parameters_category = ORM::for_table('')->raw_query("
                                                            SELECT category.id, category.categories FROM jobs 
                                                            JOIN category ON category.id = jobs.category GROUP BY category")->find_many();
        return $renderer->render($response, "index.php", [
            'jobs_listed' => $job_listed,
            'categories' => $categories,
            'parameters_cities' => $parameters_cities,
            'parameters_category' => $parameters_category,
            'jobs' => $jobs,
        ]);
    }
    public function  jobs(Request $request, Response $response, $args) {
        $renderer = new PhpRenderer('resources');

        $query_str = ORM::for_table('')->raw_query("SELECT *, jobs.id as jobs_id
            FROM jobs
            JOIN city on city.id = jobs.city 
            JOIN job_nature ON job_nature.id = jobs.job_nature 
            JOIN country ON country.id = city.country
            JOIN qualifications ON qualifications.id = jobs.qualification")->find_many();


        return $renderer->render($response, "jobs.php", [
            'query_str' => $query_str,
        ]);
    }
}
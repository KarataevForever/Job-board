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
    JOIN country ON country.id = city.country")
            ->find_many();

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
    public function jobs(Request $request, Response $response, $args) {
        $renderer = new PhpRenderer('resources');

        $job_listed = ORM::forTable('jobs')->raw_query("SELECT SUM(vacancy_tally) as sum FROM jobs")->find_one();

        $parameters_cities = ORM::for_table('jobs')->raw_query("SELECT city.id, city.citys FROM jobs 
                                                            JOIN city ON city.id = jobs.city GROUP BY city")->find_many();

        $parameters_category = ORM::for_table('')->raw_query("
                                                            SELECT category.id, category.categories FROM jobs 
                                                            JOIN category ON category.id = jobs.category GROUP BY category")->find_many();

        $parameters_job_type = ORM::for_table('')->raw_query("
                                                        SELECT job_nature.id, job_nature.job_natures FROM jobs 
                                                        JOIN job_nature ON job_nature.id = jobs.job_nature GROUP BY job_nature")->find_many();

        $parameters_qualification = ORM::for_table('')->raw_query("
                                                        SELECT qualifications.id, qualifications.qualifications FROM jobs 
                                                        JOIN qualifications ON qualifications.id = jobs.qualification GROUP BY qualification")->find_many();

        $filtered = ORM::for_table('jobs')
            ->select('*')
            ->select('jobs.id', 'jobs_id')
            ->join("city", "city.id = jobs.city")
            ->join("job_nature", "city.id = jobs.city")
            ->join("country", "country.id = city.country")
            ->join("qualifications", "qualifications.id = jobs.qualification");

        $params = $request->getQueryParams();

        if (isset($params['key']) && $params['key']) $filtered = $filtered->where_raw("LOWER(title) LIKE LOWER('%?%') OR LOWER(description) LIKE LOWER('%?%')");
        if (isset($params['l']) && $params['l'] != "") $filtered = $filtered->where('city.id', $params['l']); else $params['l'] = null;
        if (isset($params['c']) && $params['c'] != "") $filtered = $filtered->where('jobs.category', $params['c']); else $params['c'] = null;
        if (isset($params['t']) && $params['t'] != "") $filtered = $filtered->where('job_nature.id', $params['t']);  else $params['t'] = null;
        if (isset($params['q']) && $params['q'] != "") $filtered = $filtered->where('jobs.qualification', $params['q']);  else $params['q'] = null;

        $range = [0, 120000];

        if (isset($params['s']) && $params['s'] != "") {
            $range = explode("-", $params['s']);

            $filtered = $filtered->where_raw('(salary_from >= ? AND salary_to <= ?)', [$range[0], $range[1]] );
        }

        $filtered = $filtered->find_many();

        return $renderer->render($response, "jobs.php", [
            'jobs_listed' => $job_listed,
            'parameters_cities' => $parameters_cities,
            'parameters_category' => $parameters_category,
            'parameters_job_type' => $parameters_job_type,
            'parameters_qualification' => $parameters_qualification,
            'jobs' => $filtered,
            'params' => $params,
            'range' => $range,

        ]);
    }
    public function job_details(Request $request, Response $response, $args) {
        $renderer = new PhpRenderer('resources');

        $job_id = $args['id'];

        $job_info = ORM::for_table('')->raw_query("SELECT published, 
                                            vacancy_tally, 
                                            salary_from, 
                                            salary_to, 
                                            city.citys as city, 
                                            country.countries as country, 
                                            job_nature.job_natures as job_nature,
                                            description,
                                            title
                                    FROM jobs
                                    JOIN city ON jobs.city = city.id
                                    JOIN country ON city.id = country.id
                                    JOIN job_nature ON job_nature.id = jobs.job_nature
                                    WHERE jobs.id = {$job_id}")->find_one();

        $date = date( "j F, Y", strtotime( $job_info['published'] ) );

        return $renderer->render($response, "job_details.php", [
            'job_info' => $job_info,
            'date' => $date,
        ]);
    }
    public function job_handler(Request $request, Response $response, $args) {
        $params = $request->getParsedBody();

        $title = $params['title'];
        $name = $params['name'] ?? "Unknown";
        $email = $params['email'] ?? "Email";
        $portfolio = $params['portfolio'];
        $letter = $params['coverletter'];

        mail("job@jobboard.com", "{$title}", "{$name}\n{$email}\n{$portfolio}\n{$letter}");


        return $response->withStatus(302)->withHeader('Location', '/');
    }
}